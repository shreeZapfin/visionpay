<?php

namespace App\Observers;

use App\Classes\Transaction\CashbackReceivedOnTransaction;
use App\Classes\Transaction\PaymentChargeOnTransaction;
use App\Classes\Transaction\TransactionFactory;
use App\Enums\ChargePackageType;
use App\Enums\UserType;
use App\Enums\WalletTransactionType;
use App\Models\TransactionUserVoucher;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Services\PaymentChargePackageService;
use App\Services\WalletService;
use App\Services\WalletTransactionService;
use Illuminate\Support\Facades\DB;

class WalletTransactionObserver
{
    /**
     * Handle the WalletTransaction "created" event.
     *
     * @param  \App\Models\WalletTransaction $walletTransaction
     * @return void
     */
    public $afterCommit = true;

    /*This function after a transaction is commited on the basis of the transaction type does the following
        *If voucher code present in the request and valid give cashback
        *If bill payment transaction charge the biller fees
        *If fund transfer is from customer to customer charge the sender according to  ChargePackageType set for the sender of the txn
        *If fund transfer is  customer to merchant charge then charge the merchant accepting the txn according to the package set
    */
    public function created(WalletTransaction $walletTransaction)
    {

        if (!in_array($walletTransaction->transaction_type, [
            WalletTransactionType::CASHBACK,
            WalletTransactionType::BILL_PAYMENT_CHARGE,
            WalletTransactionType::P2P_PAYMENT_CHARGE,
            WalletTransactionType::MERCHANT_PAYMENT_CHARGE])) {  /*ignore not eligible wallet transaction for cashback*/
            if (request()->has('voucher_code') AND isset(request()->voucher_code)) {    /*If request had voucher code*/
                if (request()->voucher_for['voucher_redeemed_by_user_id'] == $walletTransaction->user_id) { /*if the request had voucher reemded by user id matching*/
                    /*Mark as reemdemed and Credit the cashback*/

                    DB::transaction(function () use ($walletTransaction) {
                        $user = $walletTransaction->user;
                        $reedemedVoucher = $user->redeemCode(request()->voucher_code);
                        TransactionUserVoucher::create([
                            'user_voucher_id' => $reedemedVoucher->id,
                            'wallet_transaction_id' => $walletTransaction->transaction_id
                        ]);
                        $cashbackTransactionDetails = (new CashbackReceivedOnTransaction($walletTransaction, $reedemedVoucher));
                        $userWallet = $user->wallet;

                        (new WalletService($userWallet))->credit_wallet($cashbackTransactionDetails->get_transaction_details());
                    });
                }
            }


            if ($walletTransaction->transaction_type == WalletTransactionType::BILL_PAYMENT) {
                /*Charge biller the payment charge*/

                /*Identity user type against the transaction*/
                $walletTransaction->load('user');
                /*Identify the biller*/
                if ($walletTransaction->user->user_type_id == UserType::Biller) {    /*As only charge the biller and not the customer*/
                    /*Charge the biller*/
                    (new PaymentChargePackageService())->deductPaymentChargeForWalletTxn($walletTransaction);
                }

            }

            if ($walletTransaction->transaction_type == WalletTransactionType::WALLET_TRANSFER) {
                /*Charge customer/merchant the payment charge*/
                $walletTransaction->load('fundRequest');
                if ($walletTransaction->fundRequest->is_wallet_refill)   /*If transfer is for wallet refill do not charge*/
                    return;

                if ($walletTransaction->fundRequest->is_sub_account_request) /*If transfers are between master->sub ignore charges*/
                    return;

                /*Get type of wallet transfer (p2p or merchant payment)*/
                $walletTransferType = (new WalletTransactionService())->get_type_of_wallet_transfer($walletTransaction);

                if ($walletTransferType == ChargePackageType::P2P) {

                    $walletTransaction->load('user', 'transaction.senderUser');

                    if ($walletTransaction->user->id != $walletTransaction->transaction->senderUser->id) /*We only charge the sender user for p2p*/
                        return;

                    (new PaymentChargePackageService())->deductPaymentChargeForWalletTxn($walletTransaction);

                }

                if ($walletTransferType == ChargePackageType::MERCHANT) {

                    $walletTransaction->load('user', 'transaction.requesterUser');

                    if ($walletTransaction->user->id != $walletTransaction->transaction->requesterUser->id) /*We only charge the merchant who is the requester user of payment*/
                        return;

                    (new PaymentChargePackageService())->deductPaymentChargeForWalletTxn($walletTransaction);

                }
            }
        }
    }

    /**
     * Handle the WalletTransaction "updated" event.
     *
     * @param  \App\Models\WalletTransaction $walletTransaction
     * @return void
     */
    public function updated(WalletTransaction $walletTransaction)
    {
        //
    }

    /**
     * Handle the WalletTransaction "deleted" event.
     *
     * @param  \App\Models\WalletTransaction $walletTransaction
     * @return void
     */
    public function deleted(WalletTransaction $walletTransaction)
    {
        //
    }

    /**
     * Handle the WalletTransaction "restored" event.
     *
     * @param  \App\Models\WalletTransaction $walletTransaction
     * @return void
     */
    public function restored(WalletTransaction $walletTransaction)
    {
        //
    }

    /**
     * Handle the WalletTransaction "force deleted" event.
     *
     * @param  \App\Models\WalletTransaction $walletTransaction
     * @return void
     */
    public function forceDeleted(WalletTransaction $walletTransaction)
    {
        //
    }
}
