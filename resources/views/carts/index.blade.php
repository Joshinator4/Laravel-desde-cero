@extends('layouts.app')

@section('content')
    <!-- Esta vista esta recibiendo la informacion adquirida en el modelo, y se envia aqui a través del controlador con metodo with(['product'=>$product]) -->
    <!-- En este caso se envia la informacion como product, si en el with se pone por ejemplo with(['element'=>$product]) aqui se accederia a los valores con $element-->
	<h1>Your cart</h1>



    @if(!isset($cart) || $cart->products->isEmpty())
        <div class="alert alert-warning">
            <strong>Your cart is empty</strong>
        </div>

    @else
        {{-- de esta forma accedemos al precio total del carro accediendo al atributo 'creado' total --}}
        <h4 class="text-center">
            <strong>Grand Total: {{ $cart->total }}</strong>
        </h4>
        <a class="btn btn-success mb-3" href="{{ route('orders.create') }}">
            Start Order
        </a>
        <div class="row">
            @foreach ($cart->products as $product)
                <div class="col-3">
                    <!--ASI incluimos componentes de blade para reutilizar código -->
                    @include('components.product-cart')
                </div>
            @endforeach

        </div>
    @endif
@endsection
