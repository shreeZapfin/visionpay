<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $commission_type
 * @property float $commission_value
 * @property User[] $users
 */
class CommissionScheme extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'commission_type', 'commission_value'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
