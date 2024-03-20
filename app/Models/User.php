<?php

namespace App\Models;

use App\Enums\Permissions;
use App\Traits\Maskable;
use BeyondCode\Vouchers\Traits\CanRedeemVouchers;
use EloquentFilter\Filterable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property integer $id
 * @property integer $city_id
 * @property int $user_type_id
 * @property integer $wallet_id
 * @property integer $user_permission_id
 * @property int $merchant_category_id
 * @property string $username
 * @property string $mobile_no
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $date_of_birth
 * @property string $gender
 * @property string $address
 * @property int $transaction_pin
 * @property string $selfie_img_url
 * @property string $created_at
 * @property string $updated_at
 * @property string $voter_id_img_url
 * @property string $passport_img_url
 * @property string $driver_license_img_url
 * @property string $pacpay_user_id
 * @property boolean $is_kyc_verified
 * @property City $city
 * @property Wallet $wallet
 * @property UserPermission $user_permission
 * @property MerchantCategory $merchantCategory
 * @property UserType $userType
 * @property Business $business
 * @property FundRequest[] receivedFundRequests
 * @property FundRequest[] sentFundRequests
 * @property UserBank $user_bank
 * @property UserEvents $userEvents
 * @property boolean $has_sub_accounts
 */
class User extends \Illuminate\Foundation\Auth\User
{


    use HasFactory, HasApiTokens, Filterable, CanRedeemVouchers, HasRoles , Maskable;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['city_id', 'user_type_id', 'wallet_id', 'username', 'mobile_no', 'email', 'password', 'first_name', 'last_name', 'date_of_birth', 'gender', 'address', 'transaction_pin', 'selfie_img_url', 'created_at', 'updated_at', 'kyc_document_url', 'pacpay_user_id', 'is_kyc_verified', 'is_registration_completed', 'is_verified', 'qr_code_info', 'payment_link', 'account_blocked', 'profile_pic_img_url', 'user_permission_id', 'personal_tin_no'];
    protected $hidden = ['password', 'transaction_pin', 'is_admin', 'wallet_id'];
    protected $appends = ['full_name', 'is_admin', 'user_type', 'is_sub_account'];
    protected $columns = ['account_blocked','address','city_id','commission_scheme_id','created_at','date_of_birth','email','first_name','gender','has_sub_accounts','id','is_kyc_verified','is_registration_completed','is_verified','kyc_document_expiry_date','kyc_document_id','kyc_document_type','kyc_document_url','kyc_verified_at','kyc_verified_by','last_name','master_account_user_id','mobile_no','pacpay_user_id','password','payment_link','personal_tin_no','profile_pic_img_url','qr_code_info','selfie_img_url','source_of_income_id','transaction_pin','transfer_limit_scheme_id','updated_at','user_permission_id','user_type_id','username','wallet_id'];
    protected $masked = [
        'email',
        'mobile_no',
    ];

    protected $dateFormat = 'Y-m-d h:i:s';

    protected $casts = ['is_kyc_verified' => 'boolean'];

    public function maskFields()
    {
        foreach ($this->masked as $field) {
            $this->mask($field);
        }
    }

    public function setPacpayUserIdAttribute($userId)
    {
        return $this->attributes['pacpay_user_id'] = '$' . $userId;
    }


    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getIsAdminAttribute()
    {
        if ($this->user_type_id == \App\Enums\UserType::Admin)
            return true;

        return false;
    }

    public function getUserTypeAttribute()
    {
        $userTypes = [
            \App\Enums\UserType::Admin => 'Admin',
            \App\Enums\UserType::Customer => 'Customer',
            \App\Enums\UserType::Agent => 'Agent',
            \App\Enums\UserType::Merchant => 'Merchant',
            \App\Enums\UserType::Biller => 'Biller',
            \App\Enums\UserType::AdminCommission => 'Admin Commission',
            \App\Enums\UserType::SubAccount => 'Sub account',
            \App\Enums\UserType::AdminWithdrawal => 'Admin withdrawal',
            \App\Enums\UserType::Staff => 'Staff'
        ];

        return $userTypes[$this->user_type_id];
    }

    public function getIsSubAccountAttribute()
    {
        if ($this->master_account_user_id != null)
            return true;
        return false;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wallet()
    {
        return $this->belongsTo('App\Models\Wallet');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userType()
    {
        return $this->belongsTo('App\Models\UserType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function business()
    {
        return $this->hasOne('App\Models\Business');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receivedFundRequests()
    {
        return $this->hasMany('App\Models\FundRequest', 'sender_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentFundRequests()
    {
        return $this->hasMany('App\Models\FundRequest', 'requester_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transferLimitScheme()
    {
        return $this->belongsTo('App\Models\TransferLimitScheme');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commissionScheme()
    {
        return $this->belongsTo('App\Models\CommissionScheme');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function agent()
    {
        return $this->hasOne('App\Models\Agent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function biller()
    {
        return $this->hasOne('App\Models\Biller');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deposits()
    {
        return $this->hasMany('App\Models\Deposit', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vouchers_reedemeed()
    {
        return $this->hasMany('App\Models\UserVoucher', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complaints()
    {
        return $this->hasMany('App\Models\Complaint', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function verifiedBy()
    {
        return $this->belongsTo('App\Models\User', 'kyc_verified_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function paymentChargePackage()
    {
        return $this->belongsToMany('App\Models\PaymentChargePackage', 'user_charge_package');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fcm_tokens()
    {
        return $this->hasMany('App\Models\FcmToken');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user_permission()
    {
        return $this->belongsTo('App\Models\UserPermission');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function user_bank()
    {
        return $this->hasMany('App\Models\UserBank');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sub_accounts()
    {
        return $this->hasMany('App\Models\User', 'master_account_user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function master_account()
    {
        return $this->belongsTo('App\Models\User', 'master_account_user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userEvents()
    {
        return $this->hasMany('App\Models\UserEvent', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function sourceOfIncome()
    {
        return $this->hasOne('App\Models\SourceOfIncome', 'id', 'source_of_income_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function walletTransactions()
    {
        return $this->hasMany('App\Models\WalletTransaction');
    }


    /*This function can be used to exclude certain columns where eloquent is used*/
    public function scopeExclude($query, $value = [])
    {
        return $query->select(array_diff($this->columns, (array) $value));
    }


    function scopeVerifiedUsers($query)
    {
        return $query->where('is_kyc_verified', true);
    }


    function createAgentProfile()
    {
        $agent = $this->agent()->firstOrCreate();
        $agent->agentWallets()->firstOrCreate(['wallet_type' => 'FUNDS']);
        $agent->agentWallets()->firstOrCreate(['wallet_type' => 'COMMISSION']);
        $this->givePermissionTo([Permissions::MANAGE_USER_VERIFICATION, Permissions::UPLOAD_USER_DOCUMENT, Permissions::EDIT_USER_BASIC_DETAILS]);


    }

    function hasTokenAbilityTo($ability)
    {
        return array_key_exists($ability, array_flip($this->accessToken->abilities));
    }

}
