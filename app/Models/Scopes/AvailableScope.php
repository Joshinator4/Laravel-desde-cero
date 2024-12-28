<?php
//!Esto es un scope global que filtrará las query que se hagan en todos los Model
namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AvailableScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        //!En este caso como solo se usarará en los productos, se llama al scopre local scopeAvailable que sta definido en el modelo Product
        $builder->available();
    }
}
