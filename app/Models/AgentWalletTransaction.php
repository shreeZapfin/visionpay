<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $agent_wallet_id
 * @property float $opening_balance
 * @property float $closing_balance
 * @property float $credit_amount
 * @property float $debit_amount
 * @property string $transaction_id
 * @property string $transaction_type
 * @property string $created_at
 * @property string $updated_at
 * @property string $description
 * @property AgentWallet $agentWallet
 */
class AgentWalletTransaction extends Model
{
    use Filterable;
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['agent_wallet_id', 'opening_balance', 'closing_balance', 'credit_amount', 'debit_amount', 'transaction_id', 'transaction_type', 'created_at', 'updated_at', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agentWallet()
    {
        return $this->belongsTo('App\Models\AgentWallet');
    }

    /**
     * Get the parent transaction model (fund request or rechange etc).
     */
    public function transaction()
    {
        return $this->morphTo(__FUNCTION__, 'transaction_type', 'transaction_id');
    }
}
