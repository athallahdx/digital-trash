<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\DepositTransaction;
use App\Models\WithdrawalTransaction;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'superadmin',
            'role' => 'superadmin',
            'email' => 'superadmin@example.com',
        ]);

        User::factory()->create([
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@example.com',
        ]);

        $this->call([
            CustomerSeeder::class,
            DepositTransactionSeeder::class,
            WithdrawalTransactionSeeder::class,
        ]);
    }
}
