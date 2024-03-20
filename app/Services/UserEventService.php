<?php
/**
 * Created by PhpStorm.
 * User: Ashay
 * Date: 16-07-2022
 * Time: 11:18 PM
 */

namespace App\Services;


use App\Enums\ApiEventEnum;
use App\Events\UserEventCreated;
use App\Models\FundRequest;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Support\Str;

class UserEventService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /*array */
    /*'action_user_id', 'event', 'remark','data'*/
    function createEvent(array $arr)
    {
        $ue = $this->user->userEvents()->create($arr);

        if (isset($arr['is_system_logged_event']))
            return $ue;

        UserEventCreated::dispatch($ue);

        return $ue;

    }

    function getApiEvent($request, $method)
    {
//        dd($url,$method);
        $url = $request->path();

        if ($method == 'PATCH') {
            if (Str::contains($url, 'user/permission'))
                return ApiEventEnum::UPDATED_USER_PERMISSION;

            if (Str::endsWith($url, 'wallet-balance-block'))
                return ApiEventEnum::WALLET_BALANCE_LOCKED_STATUS;

            if (Str::endsWith($url, 'account-block'))
                return ApiEventEnum::ACCOUNT_BLOCKED_STATUS;

            if ($request->route('fundrequest') instanceof FundRequest and Str::endsWith($url, 'accept'))
                return ApiEventEnum::ACCEPTED_FUNDREQUEST;

            if ($request->route('fundrequest') instanceof FundRequest and Str::endsWith($url, 'reject'))
                return ApiEventEnum::REJECTED_FUNDREQUEST;

            if ($request->route('withdrawal') instanceof Withdrawal and Str::contains($url, 'withdrawal/bank-request'))
                return ApiEventEnum::PROCESS_BANK_WITHDRAWAL;


            if ($request->route('user') instanceof User)
                return ApiEventEnum::UPDATED_USER_DETAILS;

        }
        if ($method == 'POST') {

//            if (Str::contains($url, 'login'))
//                return ApiEventEnum::INITIATED_LOGIN;

//            if (Str::contains($url, 'logout'))
//                return ApiEventEnum::INITIATED_LOGOUT;


//            if (Str::endsWith($url, 'api/user'))
//                return ApiEventEnum::INITIATED_SIGNUP;


            if (Str::contains($url, ['fund-request', 'send-funds']))
                return ApiEventEnum::INITIATED_FUND_TRANSFER;

            if (Str::contains($url, ['bill-payment']))
                return ApiEventEnum::INITIATED_BILL_PAYMENT;


            if (Str::endsWith($url, 'api/complaint'))
                return ApiEventEnum::INITIATED_COMPLAINT;


            if (Str::contains($url, ['user/selfie-image', 'user/profile-pic', 'user/kyc-document', 'user/business/company-tin-image', 'user/business/company-reg-image']))
                return ApiEventEnum::UPDATED_USER_IMAGES;


            if (Str::contains($url, ['/alert']))
                return ApiEventEnum::SENT_ALERT;

        }

        return null;
    }


}