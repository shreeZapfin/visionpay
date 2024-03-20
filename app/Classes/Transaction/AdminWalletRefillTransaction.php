<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 11:47 PM
 */

namespace App\Classes\Transaction;


use App\Enums\WalletTransactionType;
use App\Helpers\Utils;
use App\Models\Deposit;
use App\Models\WalletTransaction;


class AdminWalletRefillTransaction implements TransactionInterface
{
//    protected $transactionId;
    protected $description;
    protected $amount;

    public function __construct(WalletTransaction $walletTransaction)
    {
        $this->amount = $walletTransaction->amount;
        $this->description = 'Admin wallet refill';

    }

    function get_transaction_details(): array
    {
        return [
            'transaction_id' => 'AWR'.Utils::transaction_id_generator(),
            'description' => $this->description,
            'amount' => $this->amount,
            'transaction_type' => WalletTransactionType::ADMIN_WALLET_REFILL
        ];

    }

}