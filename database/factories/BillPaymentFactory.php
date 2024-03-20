<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BillPayment;

class BillPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var  string
     */
    protected $model = BillPayment::class;

    /**
     * Define the model's default state.
     *
     * @return  array
     */
    public function definition(): array
    {
        return [
            'biller_id' => \App\Models\Biller::factory(),
            'biller_fields' => [
                'fields' => [
                    ['name' => 'consumer no', 'value' => $this->faker->randomNumber(6)],
                    ['name' => 'amount', 'value' => $this->faker->randomNumber(3)]
                ]],
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
