<?php

namespace Database\Factories;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
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
			'url' => $faker->text(255),
			'alt_text' => $faker->text(255),
			'caption' => $faker->sentence(),
			'position' => $faker->randomNumber(),
			'is_primary' => $faker->numberBetween(0, 1),
			'product_id' => Product::inRandomOrder()->first()->id,
			'created_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'updated_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
        ];
    }
}
