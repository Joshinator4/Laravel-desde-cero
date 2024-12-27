{{-- Esto es un componente de blade que se usa para reutilizarse en varias vistas --}}
<div class="card">
    {{-- asset es un helper de laravel que se usa para acceder a algo --}}
  <img class="card-img-top" src="{{  asset($product->images->first()->path)  }}" height="500px">
  <div class="card-body">
    <h4 class="text-right"><strong>€{{$product->price}}</strong></h4>
    <h5 class="card-title">{{$product->title}}</h5>
    <p class="card-text">{{$product->description}}</p>
    <p class="card-text"><strong>{{$product->stock}} left</strong></p>


     @if (isset($cart)) {{--Si estamos en el carrito se muestra un tipo de formulario --}}
        {{-- Se muestra la informacion de cantidad de produto en el carro y el precio total de cada producto --}}
        <p class="card-text"><strong>{{$product->pivot->quantity}} in your cart ({{$product->total}}€)</strong></p>
        <form class="form-inline"
        method="POST"
        action="{{ route('products.carts.destroy', ['cart' => $cart->id,'product' => $product->id]) }}"
        >
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning">Remove Product</button>
        </form>
    @else {{--Si no estamos en el carrito se muestra otro tipo de formulario --}}
        <form class="form-inline"
        method="POST"
        action="{{ route('products.carts.store', ['product' => $product->id]) }}"
        >
            @csrf
            <button type="submit" class="btn btn-success">Add to Cart</button>
        </form>
    @endif


  </div>
</div>
{{-- <h1>name of product: {{ $product->title }} - id: ({{ $product->id }})</h1>
<p>description: {{ $product->description }}</p>
<p>price: {{ $product->price }}</p>
<p>stock: {{ $product->stock }}</p>
<p>status: {{ $product->status }}</p> --}}
