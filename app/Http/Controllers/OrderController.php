<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public $cartService;

    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
        $this->middleware("auth");//se añade una control de seguridad para asegurar que el usuario se haya autenticado
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
            ->mapWithKeys(function($product){//mapWithKeys permite asignar el valor que deseemos a la key, en este caso serán los id de los productos
                $element[$product->id] = ['quantity' => $product->pivot->quantity];

                return $element;
            });
        $order->products()->attach($cartProdcutsWithQuantity->toArray());

        return redirect()->route('orders.payments.create', ['order' => $order]);
    }

}
