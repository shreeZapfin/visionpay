<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CityFactory extends Factory
{   use HasFactory;
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = City::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'city_name' => $this->faker->city,
            'country_id' => \App\Models\Country::factory(),
        ];
    }
}
