<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
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
			'label' => $faker->text(50),
			'full_name' => $faker->text(255),
			'company' => $faker->text(255),
			'street' => $faker->text(255),
			'city' => $faker->text(100),
			'region' => $faker->text(100),
			'postal_code' => $faker->text(20),
			'country' => $faker->text(100),
			'phone' => $faker->phoneNumber(),
			'is_default_shipping' => $faker->numberBetween(0, 1),
			'is_default_billing' => $faker->numberBetween(0, 1),
			'created_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'updated_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
        ];
    }
}
