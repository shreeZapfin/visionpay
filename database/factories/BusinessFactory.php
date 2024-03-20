<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Business;

class BusinessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var  string
     */
    protected $model = Business::class;

    /**
     * Define the model's default state.
     *
     * @return  array
     */
    public function definition(): array
    {
        return [
            'business_name' => $this->faker->company,
            'company_tin_no' => $this->faker->randomNumber(),
            'company_tin_img_url' => $this->faker->imageUrl,
            'company_reg_img_url' => $this->faker->imageUrl,
            'user_id' => \App\Models\User::factory(),
            'business_type_id' => rand(1, 4),
            'merchant_category_id' => rand(1, 4),
        ];
    }
}
