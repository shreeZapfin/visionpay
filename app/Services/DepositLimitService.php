<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 1:25 AM
 */

namespace App\Services;


use App\Enums\FundRequestStatus;
use App\Enums\UserType;
use App\Enums\WalletTransactionType;
use App\Models\SystemSetting;
use App\Models\User;
use Carbon\Carbon;

class DepositLimitService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;

    }

    function is_limit_breached_this_month($amount)
    {

        if ($amount > $this->get_available_limit_this_month())
            return true;
        return false;

    }

    function get_available_limit_this_month()
    {
        $this->user->load('deposits');

        $depositLimits = SystemSetting::first(['monthly_customer_deposit_limit','monthly_merchant_deposit_limit']);

        $eligibleLimitThisMonth = ($this->user->user_type_id == UserType::Customer) ? $depositLimits->monthly_customer_deposit_limit : $depositLimits->monthly_merchant_deposit_limit;
        $consumedLimitThisMonth = $this->get_consumed_limit_this_month();

        return $eligibleLimitThisMonth - $consumedLimitThisMonth;

    }


    function get_consumed_limit_this_month()
    {
        return (new DepositService())->getDeposits([
            'user_id' => $this->user->id,
            'from_date' => new Carbon('first day of this month'),
            'to_date' => new Carbon('last day of this month'),
        ])->sum('amount');
    }

}