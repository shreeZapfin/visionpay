<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property AgentWallet[] $agentWallets
 * @property Deposit[] $deposits
 */
class Agent extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agentWallets()
    {
        return $this->hasMany('App\Models\AgentWallet');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deposits()
    {
        return $this->hasMany('App\Models\Deposit');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function agentFundsWallet()
    {
        return $this->hasOne('App\Models\AgentWallet')->where('wallet_type','FUNDS');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function agentCommissionWallet()
    {
        return $this->hasOne('App\Models\AgentWallet')->where('wallet_type','COMMISSION');
    }

}
