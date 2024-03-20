<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletFactory extends Factory
{   use HasFactory;
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Wallet::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'balance' => $this->faker->randomFloat(2,0,20000),
        ];
    }
}
