<?php
//Las rutas más básicas de Laravel aceptan una URI y un cierre, lo que proporciona un método muy simple y expresivo para definir rutas y comportamiento sin archivos de configuración de enrutamiento complicados

//acordarse de importar(use) las rutas de los controladores
//hay que tener cuidado con el orden de las rutas
//hay rutas de tipo get, post, patch, put, delete y match

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductController;





Route::get('/', [MainController::class, 'index'])->name('main');

//!Se ha creado un prefijo, filtrado por middleware y namespace diferentes para acceder al controlador products, en providers\AppServiceProvider.php
//rutas de recurso. Es un conjunto de rutas CRUD de un recurso específico1er parametro el nombre del recurso (se agrupan todos por ese nombre) se accede por ejemplo como products.destroy y el 2º el controlador
// Route::resource('products', ProductController::class);//->only(['nombredelafuncion']) con only dejamos solo el uso de las rutas que le indiquemos, ->except([]) lo mismo que only pero a la vicerserva

//rutas de recurso. Es un conjunto de rutas CRUD de un recurso específico. 1er parametro el nombre del recurso (se agrupan todos por ese nombre) se accede por ejemplo como products.carts.store y el 2º el controlador. Ruta anidada
Route::resource('products.carts', ProductCartController::class)->only('store', 'destroy');//->only(['nombredelafuncion']) con only dejamos solo el uso de las rutas que le indiquemos, ->except([]) lo mismo que only pero a la vicerserva

Route::resource('carts', CartController::class)->only('index');

Route::resource('orders', OrderController::class)->only('create', 'store');

//ruta anidada
Route::resource('orders.payments', OrderPaymentController::class)->only('create', 'store');

Auth::routes([
    'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/products', [ProductController::class, 'index'])->name("products.index");

//!la ruta atiende a verbos de HTML en este caso get.
// Route::get('products/create', [ProductController::class, 'create'])->name("products.create");

// Route::post('products', [ProductController::class, 'store'])->name("products.store");

//!Esta ruta usa products/create, pasandole una variable
// Route::get('products/{product}', [ProductController::class, 'show'])->name("products.show");

//!se le puede pasar un valor que no sea el id (que es el predefinido, usando :nombredelatributo) se debe cambiar en sus respectivas vistas para que todo funcione
//!Route::get('products/{product:title}', [ProductController::class, 'show'])->name("products.show");

// Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name("products.edit");

// Route::match(['put', 'patch'], 'products/{product}', [ProductController::class, 'update'])->name("products.update");

// Route::delete('products/{product}', [ProductController::class, 'destroy'])->name("products.destroy");


