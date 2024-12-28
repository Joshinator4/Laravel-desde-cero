<?php
//!Se ha creado este modelo para que los usuarios admin puedan editar, mostrar y eleminar los productos que estan como status = unavailable, simplemente se herea de producto y se cambia el metodo booted para indicar que ignore el global scope AvailableScope
namespace App\Models;

use App\Models\Product;
use App\Models\Scopes\AvailableScope;

class PanelProduct extends Product
{

    // protected $table = 'products';//!Esta es una forma de indicar a laravel que su tabla en la BBDD es la que se llama products y no panel_products
    protected static function booted(): void
    {
        static::withoutGlobalScope(AvailableScope::class);//!Se hace asi por el uso del #ScopedBy del modelo Product, se indica que ahora se ignnorará el global scope
        // static::addGlobalScope(new AvailableScope); Asi se haria si se ha usado el metodo booted en el modelo Product, pero se ha usado e #ScopedBy
    }
}
