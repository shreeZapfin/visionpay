<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $user_type
 * @property string $created_at
 * @property string $updated_at
 * @property User[] $users
 */
class UserType extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_type', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
