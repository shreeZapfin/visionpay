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


class DepositCommissionTransaction implements TransactionInterface
{
    protected $transactionId;
    protected $description;
    protected $amount;

    public function __construct(Deposit $deposit)
    {
        $deposit->load( 'user');
        $this->transactionId = $deposit->deposit_id;
        $this->amount = SystemSetting::first()->agent_deposit_commission;
        $this->description = 'Commission received for deposit request by ' . $deposit->user->full_name .' | PP_ID : '.$deposit->user->pacpay_user_id;
    }

    function get_transaction_details(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'description' => $this->description,
            'amount' => $this->amount ,
            'transaction_type' => WalletTransactionType::DEPOSIT_COMMISSION
        ];

    }

}