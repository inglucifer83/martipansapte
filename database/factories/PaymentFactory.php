<?php

namespace Database\Factories;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
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
			'order_id' => Order::inRandomOrder()->first()->id,
			'amount' => $faker->randomNumber(),
			'currency' => $faker->randomLetter(),
			'method' => $faker->randomElement(["card","paypal","bank_transfer","cod"]),
			'status' => $faker->randomElement(["pending","completed","failed","refunded"]),
			'transaction_id' => $faker->text(255),
			'captured_at' => Carbon::now()->subDays(rand(1, 14))->format('Y-m-d H:i:s'),
			'refunded_at' => Carbon::now()->subDays(rand(1, 14))->format('Y-m-d H:i:s'),
			'created_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
			'updated_at' => Carbon::now()->subDays(rand(1, 14))->timestamp,
        ];
    }
}
