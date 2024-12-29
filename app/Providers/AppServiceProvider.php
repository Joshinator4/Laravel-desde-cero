<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void//*en este método se definen los middleware para las rutas o componentes del proyecto
    {
        Route::middleware(['web', 'auth', 'is.admin', 'verified']) // Middleware que deseamos usar
            ->prefix('panel')       // Prefijo que se le darán a todas las rutas a las que se le asignen
            ->namespace('App\Http\Controllers\Panel')//se indica el namespace si tiene alguna subcarpeta en la que están los controladores
            ->group(base_path('routes\panel.php'));//se le indica a que grupo de rutas se le va asignar los middleware. (en este caso todas las rutas que esten en routes\panel.php)
    }
}
