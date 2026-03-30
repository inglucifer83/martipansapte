<?php

namespace Database\Factories;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class VariantFactory extends Factory
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
			'product_id' => Product::inRandomOrder()->first()->id,
			'sku' => $faker->text(100),
			'price' => $faker->randomNumber(),
			'compare_at_price' => $faker->randomNumber(),
			'inventory_quantity' => $faker->randomNumber(),
			'weight' => $faker->randomNumber(),
			'created_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'updated_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
        ];
    }
}
