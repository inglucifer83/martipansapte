<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
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
			'user_id' => User::inRandomOrder()->first()->id,
			'order_number' => $faker->text(255),
			'status' => $faker->randomElement(["pending","processing","completed","cancelled","failed"]),
			'subtotal' => $faker->randomNumber(),
			'shipping_cost' => $faker->randomNumber(),
			'tax_total' => $faker->randomNumber(),
			'total' => $faker->randomNumber(),
			'currency' => $faker->randomLetter(),
			'placed_at' => Carbon::now()->subDays(rand(1, 14))->format('Y-m-d H:i:s'),
			'fulfilled_at' => Carbon::now()->subDays(rand(1, 14))->format('Y-m-d H:i:s'),
			'tracking_number' => $faker->text(100),
			'created_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'updated_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
        ];
    }
}
