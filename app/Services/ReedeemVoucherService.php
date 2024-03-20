<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 1:12 AM
 */

namespace App\Services;


use App\Enums\UserType;
use App\Enums\VoucherModels;
use App\Exceptions\NotEligibleForVoucherException;
use App\Exceptions\VoucherNotActiveException;
use App\Exceptions\VoucherNotFoundException;
use App\Exceptions\VoucherNotUsedAgainstValidUserException;
use App\Models\AgentWallet;
use App\Models\Promotion;
use App\Models\User;
use App\Models\Wallet;
use BeyondCode\Vouchers\Events\VoucherRedeemed;
use BeyondCode\Vouchers\Models\Voucher;
use Illuminate\Support\Facades\Auth;

class ReedeemVoucherService
{

    function checkValidVoucher($code, $userId)
    {

        $voucherFor = request()->voucher_for;

        $promotion = Promotion::whereHas('voucher', function ($query) use ($code) {
            $query->where(['code' => $code]);
        })->where('promotion_transaction_type', $voucherFor['transaction_type'])
            ->first();

        if (!$promotion)
            throw new VoucherNotFoundException();

        $promotion->load('voucher');

        $voucherData = json_decode($promotion->voucher->data);

        if (!$voucherData->is_active)
            throw new VoucherNotActiveException();

        $user = User::find($userId);

        if (!$this->isEligibileForVoucher($promotion->voucher, $user))
            throw new NotEligibleForVoucherException();

        if (!$this->ifUserAgainstValidUserType($voucherData, $voucherFor['recepient_user_id'])) /*If voucher is specific to a user type*/
            throw new VoucherNotUsedAgainstValidUserException();

        if (!$this->ifUsedAgainstValidUserId($voucherData, $voucherFor['recepient_user_id'])) /*If voucher is specific to payment to particular user*/
            throw new VoucherNotUsedAgainstValidUserException();

        return true;

    }

    function reedeemVoucher(Voucher $voucher, User $user)
    {

        $user->redeemVoucher($voucher);


    }

    function isEligibileForVoucher(Voucher $voucher, User $user)
    {

        $promotionCount = Promotion::where('voucher_id', $voucher->id)->ByUser($user)->count();

        if ($promotionCount == 1)
            return true;

        return false;

    }

    function ifUsedAgainstValidUserId($voucherData, $receipeintUserId)
    {
        $masterSubUsers = User::where('id', $receipeintUserId)
            ->select('id', 'master_account_user_id')->first();

        if (isset($voucherData->user_id))
            if ($voucherData->user_id == $receipeintUserId /*Against master account*/
                || $voucherData->user_id == $masterSubUsers->master_account_user_id /*Or a sub account*/
            )
                return true;
            else
                return false;


        return true;

    }


    function ifUserAgainstValidUserType($voucherData, $receipeintUserId)
    {
        /*If voucher_for is MERCHANT_PAYMENT*/
        /*Receipeint should be a merchant*/

        if ($voucherData->voucher_for == 'MERCHANT_PAYMENT') {

            $receipeintUser = User::where('id', $receipeintUserId)
                ->select('id', 'master_account_user_id', 'user_type_id')->first();

            if ($receipeintUser->master_account()->exists()) /*Check with the master account user type to check voucher user type*/
                $receipeintUser = User::find($receipeintUser->master_account_user_id);

            if ($receipeintUser->user_type_id != UserType::Merchant) {
                return false;
            }
        }

        return true;

    }

    function getEligibleCashbackOnVoucher(Voucher $voucher, $amount)
    {

        $voucherData = json_decode($voucher->data);

        if ($voucherData->min_txn_amount)
            if ($amount < $voucherData->min_txn_amount)
                return 0;

        if ($voucherData->cashback_type == 'PERCENTAGE') {
            $cashbackAmount = $amount * $voucherData->cashback_amount / 100;
            if ($cashbackAmount > $voucherData->reward_upto_max_amount)
                $cashbackAmount = $voucherData->reward_upto_max_amount;
        } else {
            $cashbackAmount = $voucherData->cashback_amount;
        }

        return $cashbackAmount;

    }

}