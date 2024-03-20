<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 1:25 AM
 */

namespace App\Services;


use App\Enums\FundRequestStatus;
use App\Enums\WalletTransactionType;
use App\Models\User;
use Carbon\Carbon;

class TransactionLimitService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;

    }


    function is_limit_breached_this_month($amount)
    {
        if ($this->user->is_admin)
            return false;
        if ($amount > $this->get_available_limit_this_month())
            return true;
        return false;

    }

    function is_limit_breached_today($amount)
    {
        if ($this->user->is_admin)
            return false;
        if ($amount > $this->get_available_limit_today())
            return true;
        return false;

    }

    function get_available_limit_this_month()
    {
        $this->user->load('transferLimitScheme');

        $eligibleLimitThisMonth = $this->user->transferLimitScheme->eligible_limit_per_month;
        $consumedLimitThisMonth = $this->get_consumed_limit_this_month();

        return $eligibleLimitThisMonth - $consumedLimitThisMonth;

    }


    function get_available_limit_today()
    {
        $this->user->load('transferLimitScheme');

        $eligibleLimitToday = $this->user->transferLimitScheme->eligible_limit_per_day;
        $consumedLimitToday = $this->get_consumed_limit_today();
        return $eligibleLimitToday - $consumedLimitToday;

    }


    function get_consumed_limit_today()
    {
        /* return (new WalletTransactionService())->get_wallet_transactions([
             'user_id' => $this->user->id,
             'from_date' => now()->startOfDay(),
             'to_date' => now()->endOfDay(),
             'txn_type' => WalletTransactionType::WALLET_TRANSFER,
             'debit_amount_gt' => 0.00
         ])->sum('debit_amount');*/

        return (new FundRequestService())->getFundRequest([
            'sender_user_id' => $this->user->id,
            'from_date' => today()->startOfDay(),
            'to_date' => today()->endOfDay(),
            'status' => FundRequestStatus::ACCEPTED,
            'is_sub_account_request' => false
        ])->sum('amount');

    }

    function get_consumed_limit_this_month()
    {
        /*   return (new WalletTransactionService())->get_wallet_transactions([
               'user_id' => $this->user->id,
               'from_date' => new Carbon('first day of this month'),
               'to_date' => new Carbon('last day of this month'),
               'txn_type' => WalletTransactionType::WALLET_TRANSFER,
               'debit_amount_gt' => 0.00
           ])->sum('debit_amount');*/
        return (new FundRequestService())->getFundRequest([
            'sender_user_id' => $this->user->id,
            'from_date' => new Carbon('first day of this month'),
            'to_date' => new Carbon('last day of this month'),
            'status' => FundRequestStatus::ACCEPTED,
            'is_sub_account_request' => false
        ])->sum('amount');
    }

}