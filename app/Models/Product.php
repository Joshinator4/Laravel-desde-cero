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

    //Esta funcion trae los datos de la tabla pivote de carts-products. Hay que usar belong to many xq es relacion muchos a muchos.
    public function carts(){
        // return $this->belongsToMany(Cart::class)->withPivot('quantity');//!Relacion muchos a muchos simple
        return $this->morphedByMany(Cart::class, 'productable')->withPivot('quantity');//!Se usa withPivot para traer la columna quantity, si no solo traería los id respectivos. Relacion muchos a muchos polimórfica
        //!OJO el producto pertenece a muchos cart por eso morphedByMany
    }

    //Esta funcion trae los datos de la tabla pivote de order-products. Hay que usar belong to many xq es relacion muchos a muchos.
    public function orders(){
        // return $this->belongsToMany(Order::class)->withPivot('quantity');//!Relacion muchos a muchos simple
        return $this->morphedByMany(Order::class, 'productable')->withPivot('quantity');//!Se usa withPivot para traer la columna quantity, si no solo traería los id respectivos. Relacion muchos a muchos polimórfica
        //!OJO el producto pertenece a muchas order por eso morphedByMany
    }

    //esta funcion define la relacion polimórfica uno a muchos con image (1producto muchas image). Imagen puede ser de producto o de usuario
     public function images(){
        return $this->morphMany(Image::class,'imageable');//!1er argumento la clase imagen. 2º argumento el nombre de la columna de la relacion polimórfica
     }

     //!esto es un scope se llama siempre con scopeNombreDelScope y se le pasa $query como parámetro
     public function scopeAvailable($query){
        $query->where('status', 'available');
     }

     //!Este metodo genera un nuevo atributo llamado total en cada product que contará la cantidad de products en el cart u order y los multiplicará por su precio
     public function getTotalAttribute(){
        //se accede a la cantidad a través de la tabla pivote
        return $this->pivot->quantity * $this->price;
     }

}
