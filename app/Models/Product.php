<?php

namespace App\Models;

//los modelos es donde se definen las clases

//Este modelo se ha creado con php artisan make:model Product

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //se usa hasfactory para crear valores aleatorios
    use HasFactory;
    //Se crea vacio y se añade el fillable que se usa para asignar atributos de manera masiva
    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'status',
    ];
}
