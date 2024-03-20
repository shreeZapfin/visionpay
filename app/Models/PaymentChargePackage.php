<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $package_type
 * @property mixed $charges
 */
class PaymentChargePackage extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'package_type', 'charges','package_name','is_default'];

    protected $casts = ['charges' => 'array'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function User()
    {
        return $this->belongsToMany('App\Models\User','user_charge_package');
    }

    function scopeByUser($query, $userSession)
    {

        if ($userSession->user_type_id == \App\Enums\UserType::Admin)
            return $query;

        return $query->whereHas('User',function($q) use($userSession){
            $q->where('users.id',$userSession->id);
        });

    }

}
