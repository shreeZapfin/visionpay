<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Advertisement;

class AdvertisementFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Advertisement::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text('10'),
            'advertisement_img_url' => $this->faker->imageUrl,
            'advertisement_type' =>$this->faker->randomElement(['image', 'text']),
            'body' => $this->faker->text,
            'order' => $this->faker->randomDigit(),
            'status' => $this->faker->boolean,
            'redirect_to' => $this->faker->randomElement(['APP', 'WEB', 'NONE']),
            'redirect_app' => $this->faker->randomElement(['PAYMENTS', 'DEPOSIT', 'BILLER']),
            'redirect_web_url' => $this->faker->url,
        ];
    }
}
