<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/*This class is linked to user_permissions table and more permissions added should be added here*/
final class FeatureType extends Enum
{
    const FUND_REQUEST = 'fund_request';
    const DEPOSIT = 'deposit';
    const BILL_PAYMENT = 'bill_payment';
    const BANK_WITHDRAWAL = 'bank_withdrawal';
}
