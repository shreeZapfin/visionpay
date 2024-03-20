<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $bank_name
 * @property UserBank[] $userBanks
 */
class Bank extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'bank_name','swift','bsb'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userBanks()
    {
        return $this->hasMany('App\Models\UserBank');
    }


}
