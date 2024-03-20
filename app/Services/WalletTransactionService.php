<?php

/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 1:15 AM
 */

namespace App\Services;


use App\Classes\Transaction\TransactionFactory;
use App\Classes\Transaction\WalletTransactionRefundTransaction;
use App\Enums\UserType;
use App\Enums\WalletTransactionRefundType;
use App\Enums\WalletTransactionType;
use App\Exceptions\InsufficientWalletBalanceException;
use App\Exceptions\RefundNotAvailableForWalletTxnException;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;

class WalletTransactionService
{

    function create_wallet_transaction($arr)
    {
        return WalletTransaction::create($arr); /*WalletTransactionObserver is called after this is commited*/
    }

    function get_wallet_transactions($filter)
    {
        return WalletTransaction::filter($filter);
    }

    function get_type_of_wallet_transfer(WalletTransaction $walletTransaction)
    {
        if ($walletTransaction->transaction_type == 'BILL_PAYMENT')
            return 'BILL_PAYMENT';

        if ($walletTransaction->transaction_type != 'WALLET_TRANSFER')
            return null;


        $walletTransaction->load('transaction'); /*Loads FundRequest Model*/
        if ($walletTransaction->transaction->requesterUser->user_type_id == UserType::SubAccount)   /*If transffer to sub account use master account to get type of payment*/
            $walletTransaction->transaction->requesterUser = $walletTransaction->transaction->requesterUser->master_account()->first();

        if ($walletTransaction->transaction->requesterUser->user_type_id == UserType::Customer)
            return 'P2P_PAYMENT';
        if ($walletTransaction->transaction->requesterUser->user_type_id == UserType::Merchant)
            return 'MERCHANT_PAYMENT';

        return null;
    }

    function refund_wallet_txn(WalletTransaction $walletTransaction)
    {
        $user = $walletTransaction->getReceipientUserOfWalletTxn();

        if (empty($user))
            throw new RefundNotAvailableForWalletTxnException();

        if (Auth::user()->id == $user->id || Auth::user()->is_admin) /*Allow refunds by initiator of txn OR ADMIN*/ {
            /*Get all wallet txn related to the wallet txn id*/
            $txns = $this->get_wallet_transactions(['txn_id' => $walletTransaction->transaction_id])->with('user.wallet')->get();

            DB::transaction(function () use ($txns) {
                $txns->each(function ($txn) {

                    if ($txn->user->is_sub_account) {
                        $txn->load('user.master_account.wallet');
                        $userWalletService = new WalletService($txn->user->master_account->wallet); /*debit/credit from master account*/
                    } else
                        $userWalletService = new WalletService($txn->user->wallet);

                    $transactionType = (new TransactionFactory($txn))->get_transaction_type(WalletTransactionRefundType::getValue($txn->transaction_type));

                    if ($txn->debit_amount > 0) {
                        $userWalletService->credit_wallet($transactionType->get_transaction_details());
                    }
                    if ($txn->credit_amount > 0) {
                        if (!$userWalletService->is_wallet_balance_sufficient($txn->credit_amount))
                            throw new InsufficientWalletBalanceException();
                        $userWalletService->debit_wallet($transactionType->get_transaction_details());
                    }
                });
            });
        } else
            throw new UnauthorizedException();
    }
}
