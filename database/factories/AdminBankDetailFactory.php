<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AdminBankDetail;

class AdminBankDetailFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = AdminBankDetail::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'bank_name' => $this->faker->word,
            'account_no' => $this->faker->bankAccountNumber,
            'swift' => $this->faker->randomNumber(6),
            'bsb' => $this->faker->randomNumber(6)
        ];
    }
}
