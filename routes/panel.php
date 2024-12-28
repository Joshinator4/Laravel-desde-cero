<?php
//Las rutas más básicas de Laravel aceptan una URI y un cierre, lo que proporciona un método muy simple y expresivo para definir rutas y comportamiento sin archivos de configuración de enrutamiento complicados

//acordarse de importar(use) las rutas de los controladores
//hay que tener cuidado con el orden de las rutas
//hay rutas de tipo get, post, patch, put, delete y match

use App\Http\Controllers\Panel\PanelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\ProductController;

Route::resource('products', ProductController::class);

Route::get('/', [PanelController::class,'index'])->name('panel');

