<?php

namespace Database\Factories;

use App\Models\WithdrawalTransaction;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class WithdrawalTransactionFactory extends Factory
{
    protected $model = WithdrawalTransaction::class;

    public function definition()
    {
        return [
            'transaction_date' => $this->faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
            'amount' => fake()->randomElement([
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
