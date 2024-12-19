<?php

//Un crontrolador es el componente encargado de manejar la logica del negocio en cosas como crear, actualizar, eliminar, mostrar, leer, filtrar...etc debe ser realizado en un controlador
//nos salva de lidiar con la logica de negocio en el lugar incorrecto y nos permite agregar mas complejidad en las acciones que necesitamos realizar

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        // Esto es utilizando Query Builder (no es remoendable, lo mejor es utilizar el ORM Eloquent) esto no esta usando el modelo. Esto no es escalable
        // $products = DB::table('products')->get();
        // mostramos lo datos parando la ejecucuion
        // dd($products);

        //!Esto descarga una lista completa del modelo producto
        // $products = Product::all();
        // return $products; si se utiliza así devuelve los datos en formato json
        // dd($products);

        return view('products.index')->with([
            'products'=> Product::all(),
        ]);
    }

    public function create (){
        return view('products.create');
        // return "This is the form to create a product from CONTROLLER";
    }


    //la funcion store recibirá un formulario de la funcion create
    public function store (){
        // $product = Product::create([
        //Una forma sencilla de traerse los datos del POST realizado en el formulario de la vista de create.blade.php es con request()->nombre del input (name="title")por ejemplo
        //     'title' => request()->title,
        //     'description' => request()->description,
        //     'price' => request()->price,
        //     'stock' => request()->stock,
        //     'status'=> request()->status,
        // ]);
        //!Esta forma es mas rapida y directa. Este request solo pasará los atributos asignados en fillable en el model Product. ESto puede traer mas atributos que serán ignorados si no estan en fillable
        $product = Product::create(request()->all());

        return $product;
    }


    public function show ($product){
        //Esto es utilizando Query Builder (no es remoendable, lo mejor es utilizar el ORM Eloquent) esto no esta usando el modelo. Esto no es escalable
        //obtenemos un elemento de la tabla products filtrandolo por el id que se le introducirá. Como sabemos que solo devuelve 1 producto, se usa first()
        // $product = DB::table("products")->where("id", $product)->first();
        //! tambien se puede hacer así porque buscamos por id. find busca por la clave principal devolviendo toda la linea
        //! $product = DB::table("products")->find($product);
        //mostramos lo datos parando la ejecucuion
        // dd($product);

        //!El metodo find busca en el modelo el producto con id que se le pasa por parámetro
        // $product= Product::find($product);
        //!El metodo find busca en el modelo el producto con id que se le pasa por parámetro. si no existe manda una excepcion de tipo 404
        $product = Product::findOrFail($product);
        // dd($product);
        // return $product; si se utiliza así devuelve los datos en formato json

        //with recibe un array con los diferentes elementos que podemos enviar ['indiceDelArrayAsociativo'=>$valor]
        //!en este caso al indice se le envia product para ser consistente y como valor se la manda la variable $product con el producto encontrado en el metodo anterior findOrFail
        return view('products.show')->with(['product'=> $product]);
    }


    public function edit ($product){
        //!desde aqui llamamos a la vista de edit y se le pasa la variable producto buscada por el id que se recibe del html
        return view('products.edit')->with(['product'=> Product::findOrFail($product)]);
        // return "Showing the form to edit the product with id: {$product}";
    }


    public function update ($product){
        $product = Product::findOrFail($product);

        $product->update(request()->all());

        return $product;
    }


    public function destroy ($product){

        $product = Product::findOrFail($product);

        $product->delete();

        return $product;
    }
}
