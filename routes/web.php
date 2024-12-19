<?php
//Las rutas más básicas de Laravel aceptan una URI y un cierre, lo que proporciona un método muy simple y expresivo para definir rutas y comportamiento sin archivos de configuración de enrutamiento complicados

//acordarse de importar(use) las rutas de los controladores
//hay que tener cuidado con el orden de las rutas
//hay rutas de tipo get, post, patch, put, delete y match
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;


Route::get('/', [MainController::class, 'index'])->name('main');

Route::get('/products', [ProductController::class, 'index'])->name("products.index");

//la ruta atiende a verbos de HTML en este caso get.
Route::get('products/create', [ProductController::class, 'create'])->name("products.create");

Route::post('products', [ProductController::class, 'store'])->name("products.store");

//Esta ruta usa products/create, pasandole una variable
Route::get('products/{product}', [ProductController::class, 'show'])->name("products.show");

Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name("products.edit");

Route::match(['put', 'patch'], 'products/{product}', [ProductController::class, 'update'])->name("products.update");

Route::delete('products/{product}', [ProductController::class, 'destroy'])->name("products.destroy");
