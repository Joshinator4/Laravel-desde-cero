@extends('layouts.master')

@section('content')
<h1>Edit a product</h1>
<!-- En la accion del formulario se llama a la ruta por el nombre productos.update -->
<!-- El metodo es de tipo POST a la ruta llamada products.update pero esta ruta recibe un parámetro, el cual es el id del producto a editar.-->
<!-- Se le pasa un segundo parametro a route con elproducto que envia el metodo edit del ProductController -->
<form method="POST" action="{{ route('products.update', ['product' => $product->id]) }}">
    <!-- Hay que incluir csrf en nuestros formularios para que sean seguros -->
    @csrf

    <!-- Los navegadores solo aceptan POST o GET, aqui aparece el falseamiento de método, Laravel hace pasar PUT o PATCH como POST -->
    @method('PUT')
    <div class="form-row">
        <label>Title</label>

        <input class="form-control" type="text" name="title" value="{{$product->title}}" required>
    </div>
    <div class="form-row">
        <label>Description</label>
        <input class="form-control" type="text" name="description" value="{{$product->description}}" required>
    </div>
    <div class="form-row">
        <label>Price</label>

        <input class="form-control" type="number" min="1.00" step="0.01" name="price" value="{{$product->price}}" required>
    </div>
    </div>
    <div class="form-row">
        <label>Stock</label>

        <input class="form-control" type="number" min="0" name="stock" value="{{$product->stock}}" required>
    </div>
    <div class="form-row">
        <label>Status</label>
        <select class="custom-select" name="status" value="{{$product->status}}" required>
            <option {{$product->status=='available' ? 'selected' : ''}}value="available">available</option>
            <option {{$product->status=='unavailable' ? 'selected' : ''}}value="unavailable">unavailable </option>
        </select>
    </div>
    <div class="form-row">
        <button type="submit" class="btn btn-primary btn-lg">Edit product</button>
    </div>
</form>

@endsection
