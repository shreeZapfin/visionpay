<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AgentWallet;

class AgentWalletFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = AgentWallet::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'wallet_type' => $this->faker->randomElement(['FUNDS', 'COMMISSION']),
            'agent_id' => \App\Models\Agent::factory(),
            'balance' => $this->faker->randomFloat(2,100,100000),
        ];
    }
}
