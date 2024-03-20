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


class DepositTransaction implements TransactionInterface
{
    protected $transactionId;
    protected $description;
    protected $amount;

    public function __construct(Deposit $deposit)
    {
        $deposit->load('agent.user', 'user');
        $this->transactionId = $deposit->deposit_id;
        $this->amount = $deposit->amount;
        $this->description = 'Deposit request by ' . $deposit->user->full_name . ' | Agent : '.$deposit->agent->user->full_name;

    }

    function get_transaction_details(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'description' => $this->description,
            'amount' => $this->amount,
            'transaction_type' => WalletTransactionType::DEPOSIT
        ];

    }

}