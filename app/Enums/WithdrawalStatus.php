<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class WithdrawalStatus extends Enum
{
    const INITATED = 'INITIATED_BY_AGENT';
    const EXPIRED = 'EXPIRED';
    const ACCEPTED = 'ACCEPTED_BY_USER';
    const REJECTED = 'DECLINED_BY_USER';
    const BANK_WITHDRAWAL_REQUEST = 'BANK_WITHDRAWAL_REQUEST';
    const BANK_WITHDRAWAL_PAID = 'BANK_WITHDRAWAL_PAID';
    const BANK_WITHDRAWAL_FAILED = 'BANK_WITHDRAWAL_FAILED';
    const ADMIN_WITHDRAWAL = 'ADMIN_WITHDRAWAL';
}
