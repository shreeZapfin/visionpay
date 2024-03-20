<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property int $business_type_id
 * @property string $business_name
 * @property string $company_tin_no
 * @property string $business_type
 * @property string $company_tin_img_url
 * @property string $company_reg_img_url
 * @property string $created_at
 * @property string $updated_at
 * @property BusinessType $businessType
 * @property BusinessType $merchant_category_id
 * @property User $user
 */
class Business extends Model
{   use HasFactory;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'business_type_id', 'business_name', 'company_tin_no', 'business_type', 'company_tin_img_url', 'company_reg_img_url', 'created_at', 'updated_at','merchant_category_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function businessType()
    {
        return $this->belongsTo('App\Models\BusinessType');
    }

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
    public function merchantCategory()
    {
        return $this->belongsTo('App\Models\MerchantCategory');
    }

}
