<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 1:12 AM
 */

namespace App\Services;


use App\Models\Wallet;

class WalletService
{
    private $wallet;

    function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;

    }

    function credit_wallet(array $transactionDetails)
    {
        $wallet = Wallet::lockForUpdate()->find($this->wallet->id);
        (new WalletTransactionService())->create_wallet_transaction([
            'transaction_id' => $transactionDetails['transaction_id'],
            'opening_balance' => $wallet->balance,
            'closing_balance' => $wallet->balance + $transactionDetails['amount'],
            'credit_amount' => $transactionDetails['amount'],
            'transaction_type' => $transactionDetails['transaction_type'],
            'user_id' => $this->wallet->user->id,
            'description' => $transactionDetails['description']
        ]);
        $wallet->balance += $transactionDetails['amount'];
        $wallet->save();

    }

    function debit_wallet(array $transactionDetails)
    {

        $wallet = Wallet::lockForUpdate()->find($this->wallet->id);
        (new WalletTransactionService())->create_wallet_transaction([
            'transaction_id' => $transactionDetails['transaction_id'],
            'opening_balance' => $wallet->balance,
            'closing_balance' => $wallet->balance - $transactionDetails['amount'],
            'debit_amount' => $transactionDetails['amount'],
            'transaction_type' => $transactionDetails['transaction_type'],
            'user_id' => $this->wallet->user->id,
            'description' => $transactionDetails['description']
        ]);
        $wallet->balance -= $transactionDetails['amount'];
        $wallet->save();


    }

    function is_wallet_balance_sufficient($amount)
    {
        $usableBalance = $this->wallet->balance - $this->wallet->blocked_balance;

        if ($amount <= $usableBalance)
            return true;

        return false;

    }

    function get_wallet_balance()
    {

        return $this->wallet->balance;
    }

    function get_complaints_blocked_balance()
    {
        return $this->wallet->user->wallet_transactions();

    }


}