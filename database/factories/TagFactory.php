<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
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
			'name' => $faker->text(255),
			'slug' => $faker->text(255),
			'description' => $faker->sentence(),
			'color' => $faker->text(20),
			'priority' => $faker->randomNumber(),
			'created_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'updated_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
        ];
    }
}
