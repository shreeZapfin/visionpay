<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $country_name
 * @property string $created_at
 * @property string $updated_at
 * @property City[] $cities
 */
class Country extends Model
{   use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['country_name', 'created_at', 'updated_at'];
    protected $hidden = ['created_at','updated_at'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }
}
