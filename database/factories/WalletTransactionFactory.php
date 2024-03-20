<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WalletTransaction;

class WalletTransactionFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = WalletTransaction::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'opening_balance' => $this->faker->randomFloat(),
            'closing_balance' => $this->faker->randomFloat(),
            'credit_amount' => $this->faker->randomFloat(),
            'debit_amount' => $this->faker->randomFloat(),
            'transaction_id' => \App\Models\FundRequest::factory(),
            'transaction_type' => $this->faker->randomElement(['WALLET_TRANSFER', 'RECHARGE']),
            'user_id' => $this->faker->randomNumber(),
            'description' => $this->faker->text(),
        ];
    }
}
