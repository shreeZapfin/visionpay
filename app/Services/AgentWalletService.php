<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 1:12 AM
 */

namespace App\Services;


use App\Models\AgentWallet;
use App\Models\Wallet;

class AgentWalletService
{
    private $wallet;

    function __construct(AgentWallet $wallet)
    {
        $this->wallet = $wallet;

    }

    function credit_wallet(array $transactionDetails)
    {
        $wallet = AgentWallet::lockForUpdate()->find($this->wallet->id);
        (new AgentWalletTransactionService())->create_wallet_transaction([
            'transaction_id' => $transactionDetails['transaction_id'],
            'opening_balance' => $wallet->balance,
            'closing_balance' => $wallet->balance + $transactionDetails['amount'],
            'credit_amount' => $transactionDetails['amount'],
            'transaction_type' => $transactionDetails['transaction_type'],
            'agent_wallet_id' => $this->wallet->id,
            'description' => $transactionDetails['description']
        ]);
        $wallet->balance += $transactionDetails['amount'];
        $wallet->save();

    }

    function debit_wallet(array $transactionDetails)
    {

        $wallet = AgentWallet::lockForUpdate()->find($this->wallet->id);
        (new AgentWalletTransactionService())->create_wallet_transaction([
            'transaction_id' => $transactionDetails['transaction_id'],
            'opening_balance' => $wallet->balance,
            'closing_balance' => $wallet->balance - $transactionDetails['amount'],
            'debit_amount' => $transactionDetails['amount'],
            'transaction_type' => $transactionDetails['transaction_type'],
            'agent_wallet_id' => $this->wallet->id,
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


}