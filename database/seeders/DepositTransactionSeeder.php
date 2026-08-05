<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\DepositTransaction;
use Illuminate\Database\Seeder;

class DepositTransactionSeeder extends Seeder
{
    public function run(): void
    {
        Customer::all()->each(function ($customer) {
            DepositTransaction::factory(rand(0, 5))->create([
                'customer_id' => $customer->id,
            ]);
        });
    }
}