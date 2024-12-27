<?php
namespace App\Http\Controllers;

use App\Models\Product;

class MainController extends Controller
{
    public function index()
    {
        //$name = config("app.undefined", "welcome"); //esto va a buscar el valor de app.undefined, como no existe coge el valor por defecto que es "welcome"

        // dump( $name); son helpers para poder conocer el valor de la variable en el momento de la ejecución sin detenerla
        //dd($name); dd es igual que dump pero detiene la ejecucion en el

        //!esto es la llamada a un scope
        $products = Product::available()->get();

        return view("welcome")->with([
            'products'=> $products,
        ]);
    }
}
