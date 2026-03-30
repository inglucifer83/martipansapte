<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\CartItem;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeder and seed 10 Cart instances.
     *
     * @return void
     */
    public function run()
    {
        
        
        Cart::factory()
        ->count(10)->has(CartItem::factory()->count(3), 'cart_items')
			->create();
        
    }
}
