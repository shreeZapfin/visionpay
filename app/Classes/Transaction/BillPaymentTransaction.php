<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 11:47 PM
 */

namespace App\Classes\Transaction;


use App\Enums\WalletTransactionType;
use App\Models\BillPayment;

class BillPaymentTransaction implements TransactionInterface
{
    protected $transactionId;
    protected $description;
    protected $amount;

    public function __construct(BillPayment $billPayment)
    {
        $billPayment->load('biller');
        $this->transactionId = $billPayment->bill_payment_id;
        $this->amount = $billPayment->biller_fields['amount']['value'];
        $this->description = 'Bill payment | ' . $billPayment->biller->biller_name . ' - ' . $billPayment->biller_fields['primary_field']['value'] . ' |  Amount ' . $this->amount;
    }

    function get_transaction_details(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'description' => $this->description,
            'amount' => $this->amount,
            'transaction_type' => WalletTransactionType::BILL_PAYMENT
        ];

    }

}