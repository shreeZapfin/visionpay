<?php

namespace App\Models;

use BeyondCode\Vouchers\Traits\CanRedeemVouchers;
use EloquentFilter\Filterable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class UserAuthentication extends Model
{

    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id','mobile_no','status'];


}
