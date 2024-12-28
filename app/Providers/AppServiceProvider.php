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
    public function boot(): void
    {
        Route::middleware(['web', 'auth', 'is.admin', 'verified']) // Middleware
            ->prefix('panel')       // Prefijo
            ->namespace('App\Http\Controllers\Panel')
            ->group(base_path('routes\panel.php'));
    }
}
