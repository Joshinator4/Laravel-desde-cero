<!--Con extends se carga la plantilla de html que hemos creado en layouts master-->
@extends('layouts.app')

<!--Con section se bindea el contenido del yield creada en la plantilla en este caso será content-->
@section('content')

    <h1>Payment details</h1>

    <h4 class="text-center">
        <strong>Grand Total: {{ $order->total }}</strong>
    </h4>
    <div class="text-center mb-3">
        <form class="d-inline"
        method="POST"
        {{-- Al ser un controlador anidado se debe indicar a parte de la ruta el id de la order --}}
        action="{{ route('orders.payments.store', ['order' => $order->id]) }}"
        >
            @csrf
            <button type="submit" class="btn btn-success">Pay</button>
        </form>
    </div>
@endsection
