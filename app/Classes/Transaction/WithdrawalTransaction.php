<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 11:47 PM
 */

namespace App\Classes\Transaction;


use App\Enums\WalletTransactionType;
use App\Enums\WithdrawalStatus;
use App\Models\Withdrawal;


class WithdrawalTransaction implements TransactionInterface
{
    protected $transactionId;
    protected $description;
    protected $amount;

    public function __construct(Withdrawal $withdrawal)
    {
        $withdrawal->load('agent.user', 'user');
        $this->transactionId = $withdrawal->withdrawal_id;
        $this->amount = $withdrawal->amount;

        if ($withdrawal->status == WithdrawalStatus::ADMIN_WITHDRAWAL) {
            $this->description = 'Admin withdrawal |' . ($withdrawal->remark) ?: '';
        } else {
            $this->description = 'Withdrawal request by ' . $withdrawal->user->full_name;
            if ($withdrawal->getWdType() == 'agent_withdrawal_charges')
                $this->description .= ' | Agent : ' . $withdrawal->agent->user->full_name;
            else
                $this->description .= ' | Withdrawal to bank';
        }
    }

    function get_transaction_details(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'description' => $this->description,
            'amount' => $this->amount,
            'transaction_type' => WalletTransactionType::WITHDRAWAL
        ];

    }

}