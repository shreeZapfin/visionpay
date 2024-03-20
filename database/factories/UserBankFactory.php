<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserBank;

class UserBankFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = UserBank::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'bank_id' => \App\Models\Bank::all()->random()->pluck('id'),
            'bank_account_no' => $this->faker->randomNumber('10'),
            'swift' => $this->faker->swiftBicNumber,
            'bsb' => $this->faker->randomNumber('6'),
            'bank_account_name' => $this->faker->name,
        ];
    }
}
