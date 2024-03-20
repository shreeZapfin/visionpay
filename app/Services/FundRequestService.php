<?php

/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 20-Jul-21
 * Time: 4:09 AM
 */

namespace App\Services;


use App\Classes\Transaction\TransactionFactory;
use App\Enums\ChargePackageType;
use App\Enums\FundRequestStatus;
use App\Enums\FundRequestType;
use App\Enums\UserType;
use App\Enums\WalletTransactionType;
use App\Events\ReceivedFundRequestEvent;
use App\Events\SentFundRequestAcceptedEvent;
use App\Events\SentFundRequestRejectedEvent;
use App\Exceptions\DailyTransferLimitBreachedException;
use App\Exceptions\InsufficientWalletBalanceException;
use App\Exceptions\MonthtlyTransferLimitBreachedException;
use App\Helpers\Utils;
use App\Models\FundRequest;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FundRequestService
{

    function createFundRequest($arr)
    {

        $fundRequest = new FundRequest();
        //        $userId = Auth::user()->id;

        if ($arr['is_wallet_refill']) {
            $fundRequest->is_wallet_refill = $arr['is_wallet_refill'];
            $fundRequest->transaction_ref_no = isset($arr['bank_txn_id']) ? $arr['bank_txn_id']: null;
            $fundRequest->admin_bank_id = isset($arr['admin_bank_id'])  ? $arr['admin_bank_id'] : null;
            $fundRequest->sender_user_id = User::where('user_type_id', UserType::Admin)->first()->id;
        } else {
            $fundRequest->sender_user_id = $arr['request_to'];
        }

        $fundRequest->requester_user_id = $arr['requester_user_id'];
        $fundRequest->amount = $arr['amount'];
        $fundRequest->status = FundRequestStatus::REQUESTED;
        $fundRequest->request_type = isset($arr['request_type']) ? $arr['request_type'] : FundRequestType::REQUEST;
        $fundRequest->fund_request_id = 'FR' . Utils::transaction_id_generator() . $arr['requester_user_id'];
        $fundRequest->description = isset($arr['description']) ? $arr['description'] : null;
        $fundRequest->is_sub_account_request = isset($arr['is_sub_account_request']) ? $arr['is_sub_account_request'] : false;
        $fundRequest->save();
        ReceivedFundRequestEvent::dispatch($fundRequest);
        return $fundRequest;
    }

    function acceptFundRequest(FundRequest $fundRequest)
    {

        /*Check transaction limit for user*/
        /*Check available balance*/
        /*wallet transfer*/

        $user = User::find($fundRequest->sender_user_id);
        $limitService = new TransactionLimitService($user);

        if (($limitService->is_limit_breached_today($fundRequest->amount)))
            throw new DailyTransferLimitBreachedException();

        if (($limitService->is_limit_breached_this_month($fundRequest->amount)))
            throw new MonthtlyTransferLimitBreachedException();

        $senderWalletService = new WalletService($user->Wallet);

        $fundRequest->load('requesterUser');
        $charge = 0;
        if (
            $fundRequest->requesterUser->user_type_id == UserType::Customer /*IS A P2P transaction i.e requester is a CUSTOMER*/
            and $user->paymentChargePackage->isNotEmpty() /*Some users may not have a paymentCharge package like a admin ignore these*/
        ) {
            $user->load(['paymentChargePackage' => function ($q) {
                $q->where('package_type', ChargePackageType::P2P);
            }]);
            $charge = (new PaymentChargePackageService())->calculate_payment_charge($user->paymentChargePackage[0], $fundRequest->amount);
        }
        if($fundRequest->is_wallet_refill)
            $charge = 0;

        if (!$senderWalletService->is_wallet_balance_sufficient($fundRequest->amount + $charge))
            throw new InsufficientWalletBalanceException();

        DB::transaction(function () use ($senderWalletService, $fundRequest) {


            $transactionType = (new TransactionFactory($fundRequest))->get_transaction_type(WalletTransactionType::WALLET_TRANSFER);

            $senderWalletService->debit_wallet($transactionType->get_transaction_details());


            $user = User::find($fundRequest->requester_user_id);


            if (in_array($user->user_type_id, [UserType::Merchant, UserType::Customer, UserType::SubAccount, UserType::Biller])) { /*Send funds to primary wallet of users*/
                $requesterUserWallet = $user->wallet;
                $requesterWalletService = (new WalletService($requesterUserWallet));
                $requesterWalletService->credit_wallet($transactionType->get_transaction_details());
            } else { /*Send funds to agent wallet use for withdrawal use case*/
                $agentUserWallet = $user->agent->agentFundsWallet;
                $agentWalletService = (new AgentWalletService($agentUserWallet));
                $agentWalletService->credit_wallet($transactionType->get_transaction_details());
            }

            $fundRequest->status = FundRequestStatus::ACCEPTED;
            $fundRequest->save();
        });
        SentFundRequestAcceptedEvent::dispatch($fundRequest);
        return $fundRequest;
    }

    function rejectFundRequest(FundRequest $fundRequest, $remark)
    {

        $fundRequest->status = FundRequestStatus::REJECTED;
        $fundRequest->reject_remark = $remark;
        $fundRequest->save();
        SentFundRequestRejectedEvent::dispatch($fundRequest);
        return $fundRequest;
    }

    function getFundRequest($filters)
    {
        return FundRequest::filter($filters);
    }

    function sendFundsDirect($arr)
    {
        DB::transaction(function () use ($arr, &$acceptedRequest) {
            $fundRequest = $this->createFundRequest([
                'amount' => $arr['amount'],
                'request_to' => $arr['sender_user_id'],
                'requester_user_id' => $arr['send_to'],
                'is_wallet_refill' => isset($arr['is_wallet_refill']) ? $arr['is_wallet_refill'] : false,
                'description' => isset($arr['description']) ? $arr['description'] : null,
                'is_sub_account_request' => isset($arr['is_sub_account_request']) ? $arr['is_sub_account_request'] : false,
                'request_type' => FundRequestType::DIRECT
            ]);

            $acceptedRequest = $this->acceptFundRequest($fundRequest);
        });

        return $acceptedRequest;
    }
}
