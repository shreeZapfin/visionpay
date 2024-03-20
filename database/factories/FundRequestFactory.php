<?php

namespace Database\Factories;

use App\Classes\Transaction\TransactionFactory;
use App\Enums\FundRequestStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FundRequest;

class FundRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var  string
     */
    protected $model = FundRequest::class;

    /**
     * Define the model's default state.
     *
     * @return  array
     */
    public function definition(): array
    {
        return [
            'requester_user_id' => \App\Models\User::factory(),
            'sender_user_id' => \App\Models\User::factory(),
            'amount' => $this->faker->randomFloat(2, 100, 5000),
            'status' => $this->faker->randomElement(['ACCEPTED', 'REQUESTED', 'REJECTED']),
            'request_type' => $this->faker->randomElement(['DIRECT', 'REQUEST']),
            'transaction_ref_no' => $this->faker->numerify('TXN'),
            'admin_bank_id' => \App\Models\AdminBankDetail::factory(),
            'fund_request_id' => $this->faker->word,
            'is_wallet_refill' => $this->faker->boolean
        ];
    }


    public function configure()
    {
//        return $this->afterCreating(function (FundRequest $fr) {
//            if($fr->status==FundRequestStatus::ACCEPTED)
//            {
//                $this->hasTransaction(1)->create();
//
//            }
//        });
    }
}
