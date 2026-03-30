<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeder and seed 10 Order instances.
     *
     * @return void
     */
    public function run()
    {
        
        
        Order::factory()
        ->count(10)->has(OrderItem::factory()->count(4), 'order_items')
			->has(Payment::factory()->count(5), 'payments')
			->create();
        
    }
}
