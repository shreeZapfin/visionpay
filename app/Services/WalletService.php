<?php

/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 1:12 AM
 */

namespace App\Services;


use App\Events\WalletLimitBreachedEvent;
use App\Exceptions\WalletLimitBreachedException;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class WalletService
{
    private $wallet;

    function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    function credit_wallet(array $transactionDetails)
    {
        if ($this->is_wallet_limit_breached($transactionDetails['amount'])) {
            $transactionDetails['auth_user_id'] = (Auth::user()) ? Auth::user()->id : $this->wallet->user->id;
            WalletLimitBreachedEvent::dispatch($this->wallet, $transactionDetails);
            throw new WalletLimitBreachedException();
        }

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

    function get_wallet_limit()
    {
        return $this->wallet->wallet_limit;
    }

    function is_wallet_limit_breached($amount)
    {
        $totalLimit = $this->wallet->balance + $amount;

        if ($totalLimit > $this->wallet->wallet_limit)
            return true;

        return false;
    }

    function update_wallet_limit($limit)
    {
        $this->wallet->wallet_limit = $limit;
        $this->wallet->save();
    }
}
