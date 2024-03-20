<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $biller_name
 * @property mixed $biller_fields
 * @property User $user
 */
class Biller extends Model
{
    use HasFactory,Filterable;
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'created_at', 'updated_at', 'biller_name', 'biller_fields','biller_img_url','biller_category_id','is_active'];

    protected $casts = ['biller_fields' => 'array'];

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
    public function billerCategory()
    {
        return $this->belongsTo('App\Models\BillerCategory');
    }

    public function appGridFor()
    {
        return $this->morphMany(AppGrid::class, 'appGridFor','grid_for','unique_id');
    }

}
