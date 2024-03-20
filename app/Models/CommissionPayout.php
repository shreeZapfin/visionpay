<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $agent_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $payout_type
 * @property float $amount
 * @property string $payout_id
 * @property Agent $agent
 */
class CommissionPayout extends Model
{
    use Filterable;
    /**
     * @var array
     */
    protected $fillable = ['agent_id', 'created_at', 'updated_at', 'payout_type', 'amount', 'payout_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent()
    {
        return $this->belongsTo('App\Models\Agent');
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
//        if($user->user_type_id==\App\Enums\UserType::Agent)

        return $query->whereHas('agent', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });
    }

}
