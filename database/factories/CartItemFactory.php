<?php

namespace Database\Factories;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
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
			'cart_id' => Cart::inRandomOrder()->first()->id,
			'price_at_time' => $faker->randomNumber(),
			'quantity' => $faker->randomNumber(),
			'saved_for_later' => $faker->numberBetween(0, 1),
			'created_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'updated_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'product_id' => $faker->word(),
        ];
    }
}
