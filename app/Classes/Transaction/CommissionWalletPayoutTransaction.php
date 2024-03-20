<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 11:47 PM
 */

namespace App\Classes\Transaction;


use App\Enums\WalletTransactionType;
use App\Models\CommissionPayout;
use App\Models\Deposit;
use App\Models\SystemSetting;


class CommissionWalletPayoutTransaction implements TransactionInterface
{
    protected $transactionId;
    protected $description;
    protected $amount;

    public function __construct(CommissionPayout $payout)
    {

        $this->transactionId = $payout->payout_id;
        $this->amount = $payout->amount;
        $this->description = 'Commission processed to funds wallet';
    }

    function get_transaction_details(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'description' => $this->description,
            'amount' => $this->amount,
            'transaction_type' => WalletTransactionType::COMMISSION_WALLET_PAYOUT
        ];

    }

}