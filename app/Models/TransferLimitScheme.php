<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property float $eligible_limit_per_month
 * @property float $eligible_limit_per_day
 * @property string $name
 * @property User[] $users
 */
class TransferLimitScheme extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['eligible_limit_per_month', 'eligible_limit_per_day', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
