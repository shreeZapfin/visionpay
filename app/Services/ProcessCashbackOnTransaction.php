<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 17-Aug-21
 * Time: 3:40 AM
 */

namespace App\Services;


use App\Classes\Transaction\CashbackReceivedOnTransaction;
use App\Models\TransactionUserVoucher;
use App\Models\WalletTransaction;
use BeyondCode\Vouchers\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessCashbackOnTransaction
{

    function processCashback(WalletTransaction $walletTransaction, Voucher $voucher)
    {

        try {
            DB::transaction(function () use ($walletTransaction, $voucher) {
                $user = $walletTransaction->user;
                $reedemedVoucher = $user->redeemCode($voucher->code);
                TransactionUserVoucher::create([
                    'user_voucher_id' => $reedemedVoucher->id,
                    'wallet_transaction_id' => $walletTransaction->transaction_id
                ]);
                $cashbackTransactionDetails = (new CashbackReceivedOnTransaction($walletTransaction, $reedemedVoucher));
                $userWallet = $user->wallet;

                (new WalletService($userWallet))->credit_wallet($cashbackTransactionDetails->get_transaction_details());
            });
            return true;
        } catch (\Exception $exception) {
            Log::error('Something went wrong in processing cashbacks for wallet transaction : ' . json_encode($walletTransaction) . ' Exception :' . $exception);
            return false;
        }

    }


}