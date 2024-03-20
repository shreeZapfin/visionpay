<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Complaint;

class ComplaintFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Complaint::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'id' => $this->faker->randomNumber(),
            'transaction_id' => $this->faker->word,
            'complaint_type_id' => \App\Models\ComplaintType::factory(),
            'user_complaint_description' => $this->faker->text,
            'complaint_status' => $this->faker->randomElement(['PENDING', 'RESOLVED']),
            'admin_resolution_description' => $this->faker->text,
            'resolved_at' => $this->faker->dateTime(),
        ];
    }
}
