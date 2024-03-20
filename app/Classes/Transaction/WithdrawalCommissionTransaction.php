<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 11:47 PM
 */

namespace App\Classes\Transaction;


use App\Enums\WalletTransactionType;
use App\Models\Deposit;
use App\Models\SystemSetting;
use App\Models\Withdrawal;
use App\Services\WithdrawalService;


class WithdrawalCommissionTransaction implements TransactionInterface
{
    protected $transactionId;
    protected $description;
    protected $amount;

    public function __construct(Withdrawal $withdrawal)
    {

        $this->transactionId = $withdrawal->withdrawal_id;
        $this->amount = (new WithdrawalService())->getWithdrawalCommission($withdrawal->amount);
        $this->description = 'Withdrawal commission | '.$withdrawal->withdrawal_id;
    }

    function get_transaction_details(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'description' => $this->description,
            'amount' => $this->amount ,
            'transaction_type' => WalletTransactionType::WITHDRAWAL_COMMISSION
        ];

    }

}