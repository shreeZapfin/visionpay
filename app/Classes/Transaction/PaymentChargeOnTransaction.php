<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 11:47 PM
 */

namespace App\Classes\Transaction;


use App\Models\PaymentChargePackage;
use App\Models\WalletTransaction;
use App\Services\PaymentChargePackageService;



class PaymentChargeOnTransaction implements TransactionInterface
{
    protected $transactionId;
    protected $description;
    protected $amount;
    protected $txnAmount;
    protected $transaction_type;

    public function __construct(WalletTransaction $walletTransaction, PaymentChargePackage $package)
    {

        $this->transactionId = $walletTransaction->transaction_id;
        $this->txnAmount = $walletTransaction->transaction->amount;
        $this->amount = (new PaymentChargePackageService())->calculate_payment_charge($package, $walletTransaction->transaction->amount);
        $this->description = 'Payment charge for ( ' . $walletTransaction->description . ' )';
        $this->transaction_type = $package->package_type . '_CHARGE';
    }

    function get_transaction_details(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'description' => $this->description,
            'amount' => $this->amount,
            'transaction_type' => $this->transaction_type
        ];

    }


}