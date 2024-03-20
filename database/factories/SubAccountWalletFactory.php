<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SubAccountWallet;

class SubAccountWalletFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = SubAccountWallet::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'balance' => $this->faker->randomFloat(),
            'blocked_balance' => $this->faker->randomFloat(),
        ];
    }
}
