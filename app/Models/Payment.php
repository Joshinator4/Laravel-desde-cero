<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    protected $fillable = [
        'amount',
        'payed_at',
    ];

    //Esto es para trabajar con Carbon php. estos son los atributos que deben ser mutados a dates
    protected $dates = [
        'payed_at',
     ];
}
