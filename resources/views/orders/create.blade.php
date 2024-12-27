<!--Con extends se carga la plantilla de html que hemos creado en layouts master-->
@extends('layouts.app')

<!--Con section se bindea el contenido del yield creada en la plantilla en este caso será content-->
@section('content')

    <h1>Order details</h1>

    <h4 class="text-center">
        <strong>Grand Total: {{ $cart->total }}</strong>
    </h4>
    <div class="text-center mb-3">
        <form class="d-inline"
        method="POST"
        action="{{ route('orders.store') }}"
        >
            @csrf
            <button type="submit" class="btn btn-success">Confirm Order</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart->products as $product)
                    <tr>
                        <td>
                            {{-- asset es un helper de laravel que se usa para acceder a algo --}}
                            <img src="{{ asset($product->images->first()->path) }}" style="width: 100px">
                            {{ $product->title}}
                        </td>
                        <td>{{ $product->price}}</td>
                        <td>{{ $product->pivot->quantity}}</td>
                        <td>
                            <strong>{{ $product->total }}€</strong>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
