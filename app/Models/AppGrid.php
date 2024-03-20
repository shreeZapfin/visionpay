<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $label
 * @property string $logo_url
 * @property string $type
 * @property string $redirect_to
 * @property int $unique_id
 * @property string $grid_for
 * @property int $grid_no
 */
class AppGrid extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'app_grid';

    /**
     * @var array
     */
    protected $fillable = ['label', 'logo_url', 'type', 'redirect_to', 'unique_id', 'grid_for', 'grid_no'];


    public function appGridFor()
    {
        return $this->morphTo(__FUNCTION__,'grid_for','unique_id');
    }

}
