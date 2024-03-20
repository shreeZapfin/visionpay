<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 11:47 PM
 */

namespace App\Classes\Transaction;


use App\Enums\WalletTransactionRefundType;
use App\Enums\WalletTransactionType;
use App\Models\WalletTransaction;
use App\Models\Withdrawal;


class WalletTransactionRefundTransaction implements TransactionInterface
{
    protected $transactionId;
    protected $description;
    protected $amount;
    protected $txnType;
    public function __construct(WalletTransaction $walletTransaction)
    {
        $this->transactionId = $walletTransaction->transaction_id;
        $this->amount = ($walletTransaction->debit_amount > 0) ? $walletTransaction->debit_amount : $walletTransaction->credit_amount;
        $this->description = 'Wallet transaction refunded';
        $this->txnType = WalletTransactionRefundType::getValue($walletTransaction->transaction_type);
    }

    function get_transaction_details(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'description' => $this->description,
            'amount' => $this->amount,
            'transaction_type' => $this->txnType
        ];

    }

}