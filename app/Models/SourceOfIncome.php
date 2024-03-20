<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $source
 */
class SourceOfIncome extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'source_of_income';

    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'source'];

}
