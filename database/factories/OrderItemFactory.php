<?php

namespace Database\Factories;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
		srand(hrtime(true));
        

        $faker = fake();

        return [
			'order_id' => Order::inRandomOrder()->first()->id,
			'name_snapshot' => $faker->text(255),
			'sku_snapshot' => $faker->text(100),
			'unit_price' => $faker->randomNumber(),
			'quantity' => $faker->randomNumber(),
			'total_price' => $faker->randomNumber(),
			'tax_amount' => $faker->randomNumber(),
			'created_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'updated_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'product_id' => $faker->word(),
        ];
    }
}
