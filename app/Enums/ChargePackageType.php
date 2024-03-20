<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class ChargePackageType extends Enum
{
    const BILL = 'BILL_PAYMENT';
    const MERCHANT = 'MERCHANT_PAYMENT';
    const P2P = 'P2P_PAYMENT';
}
