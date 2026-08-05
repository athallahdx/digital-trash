<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public function definition()
    {
        $prefix = $this->faker->randomElement([
            '0811', '0812', '0813',
            '0821', '0822', '0823',
            '0851', '0852', '0853',
            '0855', '0856', '0857', '0858',
            '0877', '0878',
            '0881', '0882', '0883', '0887', '0888',
            '0895', '0896', '0897', '0898', '0899',
        ]); 

        return [
            'name' => $this->faker->name(),
            'balance' => 0,
            'address' => $this->faker->address(),
            'phone' => $prefix . $this->faker->numerify('########'),
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
