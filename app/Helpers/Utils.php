<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 20-Jul-21
 * Time: 4:44 AM
 */

namespace App\Helpers;


use App\Exceptions\InvalidTransactionPinException;
use App\Models\TransferLimitScheme;
use App\Models\User;
use App\Services\TransactionLimitService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Utils
{

    static function transaction_id_generator()
    {
        return strtotime(now()).rand(100,999);
    }

    static function check_transaction_pin($pin)
    {
        if (Hash::check($pin, Auth::user()->transaction_pin))
            return true;

        throw new InvalidTransactionPinException();
    }

    static function is_transfer_limit_scheme_change_possible(User $user, TransferLimitScheme $transferLimitScheme)
    {
        /*Cannot change user limit scheme if
          User has consumed transfer limit more then new scheme eligible limit per month/day
        */
        $consumedLimitThisMonth = (new TransactionLimitService($user))->get_consumed_limit_this_month();
        $consumedLimitToday = (new TransactionLimitService($user))->get_consumed_limit_today();


        if ($consumedLimitThisMonth >= $transferLimitScheme->eligible_limit_per_month)
            abort(400,'This user has available limit per month less then new scheme setting');

        if ($consumedLimitToday >= $transferLimitScheme->eligible_limit_per_day)
            abort(400,'This user has available limit per day less then new scheme setting');


        return true;

    }

}