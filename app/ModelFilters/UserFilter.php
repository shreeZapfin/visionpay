<?php

namespace App\ModelFilters;

use App\Enums\UserType;
use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];
    protected $camel_cased_methods = false;
    protected $drop_id = false;

    public function id($id)
    {
        return $this->where('id', $id);
    }


    public function name($name)
    {
        return $this->where(function ($q) use ($name) {
            return $q->where('first_name', 'LIKE', "$name%")
                ->orWhere('last_name', 'LIKE', "$name%");
        });
    }

    public function search($usernameOrMobileNo)
    {
        return $this->where(function ($q) use ($usernameOrMobileNo) {
            return $q->where('username', 'LIKE', "$usernameOrMobileNo%")
                ->orWhere('mobile_no', 'LIKE', "$usernameOrMobileNo%")
                ->orWhere('email', 'LIKE', "$usernameOrMobileNo%")
                ->orWhere('first_name', 'LIKE', "$usernameOrMobileNo%")
                ->orWhere('last_name', 'LIKE', "$usernameOrMobileNo%")
                ->orWhereHas('business', function ($q) use ($usernameOrMobileNo) {
                    $q->where('business_name', 'LIKE', "$usernameOrMobileNo%");
                });
        });
    }

    public function user_type_id($userType)
    {
        $query = $this->where('user_type_id', $userType);

        if ($userType == UserType::Agent)
            $query->with('agent.agentWallets');
    }

    public function is_pending_verification($boolean)
    {
        if ($boolean)
            return $this->where(['is_kyc_verified' => false, 'is_registration_completed' => true])->with(['userEvents' => function ($q) {
                $q->latest();
            }]);
        else
            return $this->where(['is_kyc_verified' => true]);
    }

    public function registration_status($boolean)
    {
        if ($boolean)
            return $this->where(['is_registration_completed' => true]);
        else
            return $this->where(['is_registration_completed' => false]);
    }

    public function is_wallet_amount_blocked($boolean)
    {
        if ($boolean)
            return $this->whereHas('wallet', function ($q) {
                $q->where('blocked_balance', '>', 0);
            })->orWhereHas('agent.agentWallets', function ($q) {
                $q->where('blocked_balance', '>', 0)
                    ->where('wallet_type', 'FUNDS');
            });
    }

    function kyc_verified_by($id)
    {
        return $this->where('kyc_verified_by', $id)->with('verifiedBy:id,first_name,last_name,user_type_id');
    }

    function kyc_verified_between($dates)
    {
        $dates[1] = Carbon::parse($dates[1])->endOfDay();
        return $this->whereBetween('kyc_verified_at', $dates)->with('verifiedBy:id,first_name,last_name,user_type_id');
    }

    function gender($gender)
    {
        return $this->where('gender', $gender);
    }

    function city($city)
    {
        return $this->whereHas('City', function ($q) use ($city) {
            $q->where('city_name', 'like', $city . '%');
        });
    }

    function voucher_id($id)
    {
        return $this->whereHas('vouchers_reedemeed', function ($q) use ($id) {
            $q->where('voucher_id', $id);
        });
    }

    function has_sub_accounts($boolean)
    {
        return $this->where('has_sub_accounts', $boolean);
    }

    function master_account_user_id($id)
    {
        return $this->where('master_account_user_id', $id);
    }
}
