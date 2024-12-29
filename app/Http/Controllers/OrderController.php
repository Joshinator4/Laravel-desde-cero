<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{

    public $cartService;

    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
        $this->middleware('auth');//se añade una control de seguridad para asegurar que el usuario se haya autenticado
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cart = $this->cartService->getFromCookie();
            //!   !isset($cart) significa si no existe el cart. Isset es una funcion que comprueba si esta definido el parámetro introducido
        if (!isset($cart) || $cart->products->isEmpty()) {
            return redirect()
                ->back()
                ->withErrors("Your cart is empty!");
        }

        return view('orders.create')->with([
            'cart' => $cart
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //!Asi se usa una transacción en la BBDD. si esta todo correcto hace commit, si falla algo rollback. DB es un facade
        return DB::transaction(function () use( $request ) {
            // $user = Auth::user(); se puede hacer con el facades Auth
            $user = $request->user();//se puede hacer através de la peticion. A traves del request asociado a la autenticación se recibe el usuario

            //creamos una orden en la BBDD a través de create pasandole solo el statusya que el customer_id lo cogera del user, el status se pone como pending pouque falta pagarla
            $order = $user->orders()->create([
                'status' => 'pending'
            ]);

            $cart = $this->cartService->getFromCookie();//ya se sabe que existe el carrito no hace falta comprobarlo

            //se hace un mapeo del cart para quedarnos con el id de los productos (key) y la cantidad (value)
            $cartProdcutsWithQuantity = $cart
                ->products
                ->mapWithKeys(function($product){//mapWithKeys permite asignar el valor que deseemos a la key, en este caso serán los id de los productos. Hace un mapeo del array products
                    $quantity = $product->pivot->quantity;
                    //!Este condicional se crea cerciorarnos que la cantidad solicitada en el carrito para crear la orden no supera el stock
                    if($product->stock < $quantity){
                        //?Si no hay mas quantity solicitada que el stock, lanzará una excecpción de validacion
                        throw ValidationException::withMessages([
                            'product'=> "There is not enough stock for the quantity you required of {$product->title}"
                        ]);//*muy importante disparar la excepcion ya que estamos dentro de una transacción para que salte el rollback
                    }

                    $product->decrement('stock', $quantity);//*Esta funcion decrementa en la BBDD a la columna pasada como 1er argumento la cantidad pasada por el 2º argumento

                    //!A cada elemento se le pone como key el id del product y como valor se le pasa un array declarativo con key 'quantity' value la cantidad
                    $element[$product->id] = ['quantity' => $quantity];

                    return $element;
                });
            $order->products()->attach($cartProdcutsWithQuantity->toArray());

            return redirect()->route('orders.payments.create', ['order' => $order]);

        }, 3);//! Se le puede pasar un segundo parámero que son el numero de intentos que se va a intentar realizar el proceso
    }

}
