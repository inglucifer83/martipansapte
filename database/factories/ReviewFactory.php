<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
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
			'product_id' => Product::inRandomOrder()->first()->id,
			'rating' => $faker->randomNumber(),
			'title' => $faker->text(255),
			'body' => $faker->sentence(),
			'approved' => $faker->numberBetween(0, 1),
			'helpful_count' => $faker->randomNumber(),
			'created_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'updated_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
        ];
    }
}
