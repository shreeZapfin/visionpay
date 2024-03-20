<?php

namespace Database\Factories;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserFactory extends Factory
{
    use HasFactory;
    /**
     * The name of the factory's corresponding model.
     *
     * @var  string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return  array
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName,
            'mobile_no' => $this->faker->word,
            'email' => $this->faker->safeEmail,
            'password' => bcrypt($this->faker->password),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['MALE', 'FEMALE', 'TRANSGENDER']),
            'address' => $this->faker->text,
            'transaction_pin' => $this->faker->randomNumber(),
            'selfie_img_url' => $this->faker->imageUrl(),
            'profile_pic_img_url' => $this->faker->imageUrl(),
            'kyc_document_url' => $this->faker->imageUrl(),
            'city_id' => \App\Models\City::factory(),
            'user_type_id' => rand(1, 4),
            'wallet_id' => \App\Models\Wallet::factory(),
            'pacpay_user_id' => $this->faker->word,
            'is_kyc_verified' => $this->faker->boolean,
            'kyc_document_type' => $this->faker->randomElement(['VOTERID', 'DRIVING_LICENSE', 'PASSPORT']),
            'kyc_document_id' => $this->faker->randomNumber(8),
            'kyc_document_expiry_date' => $this->faker->date,
            'user_permission_id' => \App\Models\UserPermission::factory(),
        ];
    }
}
