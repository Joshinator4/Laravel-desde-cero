<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //!Se lanza con php artisan migarate:fresh --seed
        //!fresh rehace la BBDD y con seed se lanza el seeder para crear 50 productos en este caso
        //!tambien se puede lanzar php artisan db:seed  esto lanzara otros 50 productos pero añadiendolo a los datos que ya tiene la BBDD
        User::factory(3)->create();
        Product::factory(50)->create();
        Image::factory(50)->create();
        Image::factory(3)->user()->create();
        Cart::factory(10)->create();
        Order::factory(20)->create();
        Payment::factory(15)->create();



    }
}
