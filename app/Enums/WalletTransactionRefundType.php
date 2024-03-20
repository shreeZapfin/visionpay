<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class WalletTransactionRefundType extends Enum
{
    const WALLET_TRANSFER = 'WALLET_TRANSFER_REFUND';
    const RECHARGE = 'RECHARGE_REFUND';
    const DEPOSIT = 'DEPOSIT_REFUND';
    const DEPOSIT_COMMISSION = 'DEPOSIT_COMMISSION_REFUND';
    const WITHDRAWAL = 'WITHDRAWAL_REFUND';
    const WITHDRAWAL_CHARGE = 'WITHDRAWAL_CHARGE_REFUND';
    const WITHDRAWAL_COMMISSION = 'WITHDRAWAL_COMMISSION_REFUND';
    const COMMISSION_CASH_PAYOUT = 'COMMISSION_CASH_PAYOUT_REFUND';
    const COMMISSION_WALLET_PAYOUT = 'COMMISSION_WALLET_PAYOUT_REFUND';
    const ADMIN_WALLET_REFILL = 'ADMIN_WALLET_REFILL_REFUND';
    const BILL_PAYMENT = 'BILL_PAYMENT_REFUND';
    const CASHBACK = 'CASHBACK_REFUND';
    const BILL_PAYMENT_CHARGE ='BILL_PAYMENT_CHARGE_REFUND';
    const MERCHANT_PAYMENT_CHARGE = 'MERCHANT_PAYMENT_CHARGE_REFUND';
    const P2P_PAYMENT_CHARGE = 'P2P_PAYMENT_CHARGE_REFUND';
    const WITHDRAWAL_CHARGE_REFUND = 'WITHDRAWAL_CHARGE_REFUND';
    const WITHDRAWAL_REFUND = 'WITHDRAWAL_REFUND';
    const WALLET_TRANSACTION_REFUND = 'WALLET_TRANSACTION_REFUND';


}