{{-- Esto es un componente de blade que se usa para reutilizarse en varias vistas --}}
<h1>name of product: {{ $product->title }} - id: ({{ $product->id }})</h1>
<p>description: {{ $product->description }}</p>
<p>price: {{ $product->price }}</p>
<p>stock: {{ $product->stock }}</p>
<p>status: {{ $product->status }}</p>
