<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $business_type
 * @property Business[] $businesses
 */
class BusinessType extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['business_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function businesses()
    {
        return $this->hasMany('App\Models\Business');
    }
}
