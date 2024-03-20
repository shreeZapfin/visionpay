<?php

namespace Database\Factories;

use App\Models\BillerCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Biller;

class BillerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var  string
     */
    protected $model = Biller::class;

    /**
     * Define the model's default state.
     *
     * @return  array
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'biller_name' => $this->faker->company,
            'biller_fields' => [
                'fields' => [
                    ['name' => 'consumer no','check_regex' => true ,'regex' => '/^\\d\\d\\d\\d\\d$/i'],
                    ['name' => 'amount','check_regex' => true ,'regex' => '/^[0-9]+$/']
                ]
            ],
            'biller_category_id' => BillerCategory::factory()
        ];
    }
}
