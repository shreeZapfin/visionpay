<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $bank_name
 * @property string $account_no
 * @property FundRequest[] $fundRequests
 */
class AdminBankDetail extends Model
{    use SoftDeletes,HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['bank_name', 'account_no','swift','bsb'];
    protected $hidden=['deleted_at','created_at','updated_at'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fundRequests()
    {
        return $this->hasMany('App\Models\FundRequest', 'admin_bank_id');
    }
}
