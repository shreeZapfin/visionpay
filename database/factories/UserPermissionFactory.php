<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserPermission;

class UserPermissionFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = UserPermission::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'fund_request' => true,
            'bank_withdrawal' => true,
            'bill_payment' => true,
            'deposit' => true,
        ];
    }
}
