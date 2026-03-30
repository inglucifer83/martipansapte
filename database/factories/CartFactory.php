<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
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
			'token' => $faker->text(255),
			'currency' => $faker->randomLetter(),
			'total_amount' => $faker->randomNumber(),
			'expires_at' => Carbon::now()->subDays(rand(1, 14))->format('Y-m-d H:i:s'),
			'is_active' => $faker->numberBetween(0, 1),
			'created_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'updated_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
        ];
    }
}
