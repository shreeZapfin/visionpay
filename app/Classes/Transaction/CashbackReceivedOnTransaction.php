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
use App\Models\WalletTransaction;
use App\Services\ReedeemVoucherService;
use BeyondCode\Vouchers\Events\VoucherRedeemed;
use BeyondCode\Vouchers\Models\Voucher;


class CashbackReceivedOnTransaction implements TransactionInterface
{
    protected $transactionId;
    protected $description;
    protected $amount;
    protected $txnAmount;

    public function __construct(WalletTransaction $walletTransaction, Voucher $voucher)
    {

        $this->transactionId = $walletTransaction->transaction_id;
        $this->txnAmount = ($walletTransaction->debit_amount) ? $walletTransaction->debit_amount : $walletTransaction->credit_amount;
        $this->amount = $this->calculate_voucher_cashback($voucher);
        $this->description = 'Cashback received ( ' . $walletTransaction->description . ' )';
    }

    function get_transaction_details(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'description' => $this->description,
            'amount' => $this->amount,
            'transaction_type' => WalletTransactionType::CASHBACK
        ];

    }


    function calculate_voucher_cashback(Voucher $voucher)
    {
        return (new ReedeemVoucherService())->getEligibleCashbackOnVoucher($voucher, $this->txnAmount);
    }

}