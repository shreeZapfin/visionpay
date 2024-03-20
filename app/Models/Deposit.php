<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property int $agent_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property float $amount
 * @property string $deposit_id
 * @property Agent $agent
 * @property User $user
 */
class Deposit extends Model
{
    use Filterable,HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['agent_id', 'user_id', 'created_at', 'updated_at', 'amount', 'deposit_id', 'commission_processed'];


    /*Below 3 attributes Added so that polymorph from wallet_transaction works properly*/
     protected $keyType = 'string';
     protected $primaryKey='deposit_id';
     public $incrementing = false;

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
        return $this->hasOneThrough('App\Models\User','App\Models\Agent','id','id','agent_id','user_id');
    }


    public function scopeByUser($query,User $user)
    {
        if($user->is_admin)
            return $query;
        if($user->user_type_id==\App\Enums\UserType::Agent)
            return $query->whereHas('agent',function($query) use($user){
               $query->where('user_id',$user->id);
            });
        return $query->where('user_id',$user->id);
    }


    /**
     * Get the wallet transaction.
     */
    public function transaction()
    {
        return $this->morphMany(WalletTransaction::class, 'transaction','transaction_type','transaction_id','deposit_id');
    }
    /**
     * Get the agent wallet transaction.
     */
    public function agent_transaction()
    {
        return $this->morphMany(AgentWalletTransaction::class, 'transaction','transaction_type','transaction_id','deposit_id');
    }

}
