<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class TransactionPrimaryFields extends Enum
{
const WALLET_TRANSFER = 'fund_request_id';
const DEPOSIT = 'deposit_id';
const DEPOSIT_COMMISSION = 'deposit_id';
const WITHDRAWAL = 'withdrawal_id';
const WITHDRAWAL_CHARGE = 'withdrawal_id';
const WITHDRAWAL_COMMISSION = 'withdrawal_id';
const BILL_PAYMENT = 'bill_payment_id';

}
