<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CommissionPayout;

class CommissionPayoutFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = CommissionPayout::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'payout_type' => $this->faker->randomElement(['WALLET', 'CASH']),
            'amount' => $this->faker->randomFloat(),
            'payout_id' => $this->faker->word,
            'agent_id' => \App\Models\Agent::factory(),
        ];
    }
}
