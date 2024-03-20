<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 11:47 PM
 */

namespace App\Classes\Transaction;


use App\Enums\WalletTransactionType;
use App\Models\Withdrawal;
use App\Services\WithdrawalService;


class WithdrawalChargeTransaction implements TransactionInterface
{
    protected $transactionId;
    protected $description;
    protected $amount;

    public function __construct(Withdrawal $withdrawal)
    {
        $this->transactionId = $withdrawal->withdrawal_id;
        $this->amount = (new WithdrawalService())->getWithdrawalCharge($withdrawal->getWdType(), $withdrawal->amount);
        $this->description = 'Withdrawal charge | ' . $withdrawal->withdrawal_id;
    }

    function get_transaction_details(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'description' => $this->description,
            'amount' => $this->amount,
            'transaction_type' => WalletTransactionType::WITHDRAWAL_CHARGE
        ];

    }

}