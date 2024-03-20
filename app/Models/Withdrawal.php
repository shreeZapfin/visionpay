<?php

namespace App\Models;

use App\Enums\WithdrawalStatus;
use App\Services\WithdrawalService;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $user_id
 * @property int $agent_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $expires_at
 * @property string $withdrawal_id
 * @property float $amount
 * @property Agent $agent
 * @property User $user
 */
class Withdrawal extends Model
{
    use Filterable;
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'agent_id', 'created_at', 'updated_at', 'withdrawal_id', 'amount', 'expires_at', 'status', 'bank_details', 'is_bank_withdrawal','remark'];

    /*Below 3 attributes Added so that polymorph from wallet_transaction works properly*/
    protected $keyType = 'string';
    protected $primaryKey = 'withdrawal_id';
    public $incrementing = false;


    protected $casts = ['bank_details' => 'array'];

    function getWithdrawalChargeAttribute()
    {
        $wdType = $this->getWdType();

        return (new WithdrawalService())->getWithdrawalCharge($wdType, $this->amount);

    }

    function getWdType()
    {
        return ($this->is_bank_withdrawal)
            ? 'bank_withdrawal_charges'
            : 'agent_withdrawal_charges';

    }

    function getIsExpiredAttribute()
    {
        if (now()->gt($this->expires_at))
            return true;
        return false;

    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent()
    {
        return $this->belongsTo('App\Models\Agent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOneThrough
     */
    public function agent_user()
    {
        return $this->hasOneThrough('App\Models\User', 'App\Models\Agent', 'id', 'id', 'agent_id', 'user_id');
    }


    public function scopeByUser($query, User $user)
    {
        if ($user->is_admin)
            return $query;
        if ($user->user_type_id == \App\Enums\UserType::Agent)
            return $query->whereHas('agent', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        return $query->where('user_id', $user->id);
    }


    /**
     * Get the wallet transaction.
     */
    public function transaction()
    {
        return $this->morphMany(WalletTransaction::class, 'transaction', 'transaction_type', 'transaction_id', 'withdrawal_id');
    }

}
