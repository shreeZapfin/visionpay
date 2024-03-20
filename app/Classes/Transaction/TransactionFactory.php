<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 11:46 PM
 */

namespace App\Classes\Transaction;


use App\Enums\WalletTransactionRefundType;
use App\Enums\WalletTransactionType;
use App\Models\WalletTransaction;
use Illuminate\Database\Eloquent\Model;

class TransactionFactory
{
    public $transactionModel;

    public function __construct(Model $model)
    {
        $this->transactionModel = $model;
    }


    public function get_transaction_type($txnType)
    {
        /*Describe transaction classes here to intiatize transaction array objects*/

        if ($txnType == WalletTransactionType::WALLET_TRANSFER)
            return new WalletTransferTransaction($this->transactionModel);

        if ($txnType == WalletTransactionType::DEPOSIT)
            return new DepositTransaction($this->transactionModel);

        if ($txnType == WalletTransactionType::DEPOSIT_COMMISSION)
            return new DepositCommissionTransaction($this->transactionModel);

        if ($txnType == WalletTransactionType::WITHDRAWAL)
            return new WithdrawalTransaction($this->transactionModel);

        if ($txnType == WalletTransactionType::WITHDRAWAL_CHARGE)
            return new WithdrawalChargeTransaction($this->transactionModel);

        if ($txnType == WalletTransactionType::WITHDRAWAL_COMMISSION)
            return new WithdrawalCommissionTransaction($this->transactionModel);

        if ($txnType == WalletTransactionType::WITHDRAWAL_REFUND)
            return new WithdrawalRefundTransaction($this->transactionModel);

        if ($txnType == WalletTransactionType::WITHDRAWAL_CHARGE_REFUND)
            return new WithdrawalChargeRefundTransaction($this->transactionModel);

        if ($txnType == WalletTransactionType::COMMISSION_CASH_PAYOUT)
            return new CommissionCashPayoutTransaction($this->transactionModel);

        if ($txnType == WalletTransactionType::COMMISSION_WALLET_PAYOUT)
            return new CommissionWalletPayoutTransaction($this->transactionModel);

        if ($txnType == WalletTransactionType::ADMIN_WALLET_REFILL)
            return new AdminWalletRefillTransaction($this->transactionModel);

        if ($txnType == WalletTransactionType::BILL_PAYMENT)
            return new BillPaymentTransaction($this->transactionModel);

        if(in_array($txnType,WalletTransactionRefundType::asArray()))
            return new WalletTransactionRefundTransaction($this->transactionModel);


    }

}