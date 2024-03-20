<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SubAccountWalletTransaction;

class SubAccountWalletTransactionFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = SubAccountWalletTransaction::class;

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
            'transaction_id' => $this->faker->word,
            'transaction_type' => $this->faker->randomElement(['WALLET_TRANSFER', 'RECHARGE', 'DEPOSIT', 'WITHDRAWAL', 'PAYMENT', 'BILL_PAYMENT', 'WITHDRAWAL_CHARGE', 'ADMIN_WALLET_REFILL', 'CASHBACK', 'P2P_PAYMENT_CHARGE', 'MERCHANT_PAYMENT_CHARGE', 'BILL_PAYMENT_CHARGE', 'WITHDRAWAL_REFUND', 'WITHDRAWAL_CHARGE_REFUND']),
            'sub_account_id' => \App\Models\SubAccount::factory(),
            'description' => $this->faker->text,
        ];
    }
}
