<?php

namespace App\Enums;

use App\Models\BillPayment;
use App\Models\Deposit;
use App\Models\FundRequest;
use BenSampo\Enum\Enum;


final class VoucherModels extends Enum
{
    /*used to map promotion to wallet transaction type hence transaction type are enums present in wallet_transactions*/

    const BILL_PAYMENT = ['class' => BillPayment::class, 'transaction_type' => 'BILL_PAYMENT'];
    const FUND_REQUEST = ['class' => FundRequest::class, 'transaction_type' => 'WALLET_TRANSFER'];
    const DEPOSIT = ['class' => Deposit::class, 'transaction_type' => 'DEPOSIT'];
    const MERCHANT_PAYMENT = ['class' => FundRequest::class, 'transaction_type' => 'WALLET_TRANSFER'];
}
