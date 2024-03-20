<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $type_description
 * @property string $transaction_type
 * @property Complaint[] $complaints
 */
class ComplaintType extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'type_description', 'transaction_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complaints()
    {
        return $this->hasMany('App\Models\Complaint');
    }
}
