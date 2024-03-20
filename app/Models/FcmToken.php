<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $fcm_token
 * @property string $device_id
 * @property User $user
 */
class FcmToken extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    public function getRouteKeyName()
    {
        return 'fcm_token';
    }
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'created_at', 'updated_at', 'fcm_token', 'device_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
