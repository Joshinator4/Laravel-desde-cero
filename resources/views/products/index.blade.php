<!--Con extends se carga la plantilla de html que hemos creado en layouts master-->
@extends('layouts.master')

<!--Con section se bindea el contenido del yield creada en la plantilla en este caso será content-->
@section('content')
    <h1>List of Products</h1>

    <!--Se genera una condicional de blade de esta forma, siempre hay que cerrarla con {{-- @endif--}}-->
    <!--Con la funcion de JS empty filtramos si está vacia o no-->
    {{--@if (empty($products))--}}
    <!--Con la funcion de blade empty filtramos si está vacia o no. siempre hay que cerrarla con {{-- @endempty--}}-->
    @empty ($products)
        <div class="alert warning">
            This list of products is empty
        </div>

    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id}}</td>
                            <td>{{ $product->title}}</td>
                            <td>{{ $product->description}}</td>
                            <td>{{ $product->price}}</td>
                            <td>{{ $product->stock}}</td>
                            <td>{{ $product->status}}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @endempty
@endsection
