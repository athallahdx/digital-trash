<?php

namespace Database\Factories;

use App\Models\DepositTransaction;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepositTransactionFactory extends Factory
{
    protected $model = DepositTransaction::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'transaction_date' => $this->faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
            'total_amount' => fake()->randomElement([
                10_000,
                15_000,
                25_000,
                50_000,
                75_000,
                100_000,
                150_000,
                200_000,
                250_000,
                500_000,
                1_000_000,
            ]),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
