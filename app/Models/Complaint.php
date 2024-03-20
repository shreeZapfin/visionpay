<?php

namespace App\Models;

use App\Enums\Permissions;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $complaint_type_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $transaction_id
 * @property string $user_complaint_description
 * @property string $complaint_status
 * @property string $admin_resolution_description
 * @property string $resolved_at
 * @property ComplaintType $complaintType
 * @property ComplaintMessage[] $complaintMessages
 */
class Complaint extends Model
{
    use Filterable;
    /**
     * @var array
     */
    protected $fillable = ['complaint_type_id', 'created_at', 'updated_at', 'transaction_id', 'user_complaint_description', 'complaint_status', 'admin_resolution_description', 'resolved_at', 'user_id','resolved_by'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complaintType()
    {
        return $this->belongsTo('App\Models\ComplaintType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complaintMessages()
    {
        return $this->hasMany('App\Models\ComplaintMessage');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function walletTransaction()
    {
        return $this->hasOne('App\Models\WalletTransaction', 'transaction_id', 'transaction_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function scopeByUser($query, User $user)
    {

        if ($user->is_admin || $user->hasPermissionTo(Permissions::MANAGE_COMPLAINT))
            return $query;
        return $query->where('user_id', $user->id);
    }
}
