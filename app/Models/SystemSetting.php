<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $withdrawal_charge
 * @property float $withdrawal_min_charge
 * @property float $withdrawal_max_charge
 * @property mixed $withdrawal_commission_tiers
 * @property boolean $biller_transaction
 * @property boolean $deposit
 * @property boolean $fund_request
 * @property boolean $withdrawal
 * @property float $monthly_customer_deposit_limit
 * @property float $monthly_merchant_deposit_limit
 * @property float $agent_deposit_commission
 */
class SystemSetting extends Model
{
    /**
     * @var array
     */
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = ['withdrawal_charges', 'withdrawal_commission_tiers', 'biller_transaction', 'deposit', 'fund_request', 'withdrawal', 'monthly_customer_deposit_limit', 'monthly_merchant_deposit_limit', 'agent_deposit_commission', 'daily_withdrawal_limit','min_withdrawal_limit'];

    protected $casts = [
        'withdrawal_charges' => 'array',
        'withdrawal_commission_tiers' => 'array',
    ];
}
