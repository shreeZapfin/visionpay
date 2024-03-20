<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ComplaintType;

class ComplaintTypeFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = ComplaintType::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'type_description' => $this->faker->text,
            'transaction_type' => $this->faker->randomElement(['WALLET_TRANSFER', 'RECHARGE', 'DEPOSIT', 'WITHDRAWAL', 'PAYMENT', 'BILL_PAYMENT', 'WITHDRAWAL_CHARGE', 'ADMIN_WALLET_REFILL', 'CASHBACK']),
        ];
    }
}
