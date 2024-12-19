<?php

//Un crontrolador es el componente encargado de manejar la logica del negocio en cosas como crear, actualizar, eliminar, mostrar, leer, filtrar...etc debe ser realizado en un controlador
//nos salva de lidiar con la logica de negocio en el lugar incorrecto y nos permite agregar mas complejidad en las acciones que necesitamos realizar

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('products.index');
    }

    public function create (){
        return "This is the form to create a product from CONTROLLER";
    }
    public function store (){
        //
    }
    public function show ($product){
        return view('products.show');
    }
    public function edit ($product){
        return "Showing the form to edit the product with id: {$product}";
    }
    public function update ($product){
        //
    }
    public function destroy ($product){
        //
    }
}
