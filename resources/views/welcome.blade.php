@extends('layouts.app')

@section('content')
    <!-- Esta vista esta recibiendo la informacion adquirida en el modelo, y se envia aqui a través del controlador con metodo with(['product'=>$product]) -->
    <!-- En este caso se envia la informacion como product, si en el with se pone por ejemplo with(['element'=>$product]) aqui se accederia a los valores con $element-->
	<h1>Welcome</h1>

    @empty($products)
        <div class="alert alert-danger">
            <strong>No products yet!</strong>
        </div>
    @else
        <div class="row">
            {{-- @dump($products) --}}
            @foreach ($products as $product)
                <div class="col-3">
                    <!--ASI incluimos componentes de blade para reutilizar código -->
                    @include('components.product-cart')
                </div>
            @endforeach


            {{-- @dump($products) --}}
            {{-- @dd(\DB::getQueryLog()) --}}
        </div>
    @endempty
@endsection
