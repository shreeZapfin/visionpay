<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $user_id
 * @property integer $action_user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $event
 * @property string $remark
 * @property User $user
 * @property User $userAction
 */
class UserEvent extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'action_user_id', 'created_at', 'updated_at', 'event', 'remark','data'];
    protected $hidden =['actionUser'];
    protected $with = ['actionUser'];
    protected $appends = ['action_user_full_name'];

    protected $casts = ['data' => 'array'];

    public function getActionUserFullNameAttribute()
    {
      return $this->actionUser->full_name;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function actionUser()
    {
        return $this->belongsTo('App\Models\User', 'action_user_id');
    }
}
