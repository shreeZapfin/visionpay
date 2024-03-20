<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/*This class is linked to user_permissions table and more permissions added should be added here*/
final class NotificationEntities extends Enum
{
    const GENERAL = 'General';
    const FUND_REQUEST = 'Fund request';
    const WITHDRAWAL = 'Withdrawal';
    const COMPLAINT = 'Complaint';
    const PAYMENT = 'Payment';
    const VOUCHER = 'Voucher';
    const WALLET = 'Wallet';
    const KYC = 'Kyc';

}
