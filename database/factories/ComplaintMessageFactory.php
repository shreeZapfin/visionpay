<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ComplaintMessage;

class ComplaintMessageFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = ComplaintMessage::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'complaint_id' => \App\Models\Complaint::factory(),
            'message_from_user_id' => \App\Models\User::factory(),
            'message_to_user_id' => \App\Models\User::factory(),
            'message' => $this->faker->text,
        ];
    }
}
