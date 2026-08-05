<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\WithdrawalTransaction;
use Illuminate\Database\Seeder;

class WithdrawalTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $possibleAmounts = [
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
        ];

        Customer::all()->each(function ($customer) use ($possibleAmounts) {
            $withdrawalCount = rand(0, 3);

            for ($i = 0; $i < $withdrawalCount; $i++) {
                $customer->refresh();
                $balance = $customer->balance;

                if ($balance <= 0) {
                    break;
                }

                $availableAmounts = array_values(array_filter($possibleAmounts, fn ($amount) => $amount <= $balance));
                if (empty($availableAmounts)) {
                    break;
                }

                $amount = $availableAmounts[array_rand($availableAmounts)];

                WithdrawalTransaction::factory()->create([
                    'customer_id' => $customer->id,
                    'amount' => $amount,
                ]);
            }
        });
    }
}