<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderPaymentController extends Controller
{

    public $cartService;

    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
        $this->middleware("auth");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Order $order)
    {
        return view('payments.create')->with([
            'order'=> $order,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Order $order)
    {
        //!Asi se usa una transacción en la BBDD. si esta todo correcto hace commit, si falla algo rollback. DB es un facade
        return DB::transaction(function () use ($request, $order) {

            //aqui podria haber un servicio de payment tipo PaymentService::handlePayment() con un metodo que maneja la realización del pago

            //!Cuando se paga no se elimina el cart solo se quitan los productos para que pueda seguir usando el cart
            $this->cartService->getFromCookie()->products()->detach();

            //!Se crea el pago pasando el amount y el payed_at (el order_id no hace flata pasarlo porque ya lo coje por el metodo order() estan vinculados por la relacion 1 a 1)
            $order->payment()->create([
                'amount' => $order->total,
                'payed_at' => now(),
            ]);
            //se cambia el status de la order a payed
            $order->status = 'payed';
            //se guarda el order en la BBDD ya que hasta ahora no se habia guardado
            $order->save();

            //Se redirige a la página principal por medio de la ruta main con el mensaje de exito siguiente:
            return redirect()->route('main')->withSuccess("Thanks! your payment for {$order->total}€ was successful");

        }, 3);//! Se le puede pasar un segundo parámero que son el numero de intentos que se va a intentar realizar el proceso

    }

}
