<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property integer $id
 * @property integer $complaint_id
 * @property integer $message_from_user_id
 * @property integer $message_to_user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $message
 * @property Complaint $complaint
 * @property User $message_from_user
 * @property User $message_to_user
 */
class ComplaintMessage extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['complaint_id', 'message_from_user_id', 'message_to_user_id', 'created_at', 'updated_at', 'message'];
    protected $appends = ['message_type'];


    public function getMessageTypeAttribute()
    {
        if ($this->message_from_user_id == Auth::user()->id)
            return 'SENT';

        return 'RECEIVED';
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complaint()
    {
        return $this->belongsTo('App\Models\Complaint');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function message_from_user()
    {
        return $this->belongsTo('App\Models\User', 'message_from_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function message_to_user()
    {
        return $this->belongsTo('App\Models\User', 'message_to_user_id');
    }
}
