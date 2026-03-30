<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
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
			'name' => $faker->userName(),
			'email' => $faker->email(),
			'password' => Hash::make($faker->password()),
			'remember_token' => $faker->text(100),
			'avatar' => "https://i.pravatar.cc/180?img=" .rand(1, 70),
			'display_name' => $faker->sentence(),
			'phone' => $faker->phoneNumber(),
			'email_verified_at' => Carbon::now()->subDays(rand(1, 14))->format('Y-m-d H:i:s'),
			'marketing_opt_in' => $faker->numberBetween(0, 1),
			'last_login_at' => Carbon::now()->subDays(rand(1, 14))->format('Y-m-d H:i:s'),
			'role' => $faker->text(50),
			'created_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'updated_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
        ];
    }
}
