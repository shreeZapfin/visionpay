<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $category_name
 * @property Biller[] $billers
 */
class BillerCategory extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'category_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billers()
    {
        return $this->hasMany('App\Models\Biller');
    }


    public function appGridFor()
    {
        return $this->morphMany(AppGrid::class, 'appGridFor','grid_for','unique_id');
    }
}
