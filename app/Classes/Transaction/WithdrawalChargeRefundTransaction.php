<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 11:47 PM
 */

namespace App\Classes\Transaction;


use App\Enums\UserType;
use App\Enums\WalletTransactionType;
use App\Models\AgentWalletTransaction;
use App\Models\WalletTransaction;
use App\Models\Withdrawal;
use App\Services\WithdrawalService;


class WithdrawalChargeRefundTransaction implements TransactionInterface
{
    protected $transactionId;
    protected $description;
    protected $amount;

    public function __construct(Withdrawal $withdrawal)
    {


        if ($withdrawal->user->user_type_id == UserType::Agent)
            $walletTxnModel = new AgentWalletTransaction(); /*Charge is deducted from agents wallet txn table*/
        else
            $walletTxnModel = new WalletTransaction(); /*Other users have usual wallet txn table*/

        $charge = $walletTxnModel::where('transaction_id', $withdrawal->withdrawal_id)
            ->where('transaction_type', WalletTransactionType::WITHDRAWAL_CHARGE)
            ->where('user_id', $withdrawal->user->id)
            ->first();


        $this->transactionId = $withdrawal->withdrawal_id;
        $this->amount = (isset($charge)) ? $charge->debit_amount : 0;
        $this->description = 'Withdrawal charge refund | ' . $withdrawal->withdrawal_id;
    }

    function get_transaction_details(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'description' => $this->description,
            'amount' => $this->amount,
            'transaction_type' => WalletTransactionType::WITHDRAWAL_CHARGE_REFUND
        ];

    }

}