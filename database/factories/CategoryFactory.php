<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
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
			'image' => "https://d2ou4q7eh16cxk.cloudfront.net/computer/" .rand(0, 99) .".jpg",
			'sort_order' => $faker->randomNumber(),
			'seo_title' => $faker->text(255),
			'seo_description' => $faker->sentence(),
			'is_active' => $faker->numberBetween(0, 1),
			'created_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'updated_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
        ];
    }
}
