<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Deposit;

class DepositFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Deposit::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'agent_id' => \App\Models\Agent::factory(),
            'user_id' => \App\Models\User::factory(),
            'amount' => $this->faker->randomFloat(2,100,1000),
            'deposit_id' => $this->faker->unique,
            'commission_processed' => $this->faker->boolean
        ];
    }
}
