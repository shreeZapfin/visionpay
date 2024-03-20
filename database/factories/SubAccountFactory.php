<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SubAccount;

class SubAccountFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = SubAccount::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'username' => $this->faker->userName,
            'password' => bcrypt($this->faker->password),
            'sub_account_wallet_id' => \App\Models\SubAccountWallet::factory(),
            'qr_code_info' => $this->faker->text,
            'payment_link' => $this->faker->text,
            'account_blocked' => 0,
        ];
    }
}
