<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $agent_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $wallet_type
 * @property float $balance
 * @property Agent $agent
 * @property AgentWalletTransaction[] $agentWalletTransactions
 */
class AgentWallet extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['agent_id', 'created_at', 'updated_at', 'wallet_type', 'balance','blocked_balance'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent()
    {
        return $this->belongsTo('App\Models\Agent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agentWalletTransactions()
    {
        return $this->hasMany('App\Models\AgentWalletTransaction');
    }
}
