<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $title
 * @property string $body
 * @property User $user
 */
class NotificationLog extends Model
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
    protected $fillable = ['user_id', 'created_at', 'updated_at', 'title', 'body'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    function scopeByUser($query, $userSession)
    {

        if ($userSession->user_type_id == \App\Enums\UserType::Admin)
            return $query;

        return $query->where('user_id', $userSession->id);

    }

}
