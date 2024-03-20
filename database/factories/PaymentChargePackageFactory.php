<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PaymentChargePackage;

class PaymentChargePackageFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = PaymentChargePackage::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'package_name' => $this->faker->word,
            'package_type' => $this->faker->randomElement(['BILL_PAYMENT', 'MERCHANT_PAYMENT', 'P2P_PAYMENT']),
            'charges' => $this->faker->word,
            'is_default' => $this->faker->boolean,
        ];
    }
}
