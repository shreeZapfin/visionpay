<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 26-Jan-22
 * Time: 8:17 PM
 */

namespace App\Services;


use App\Enums\FeatureType;
use App\Enums\UserType;
use App\Enums\WalletTransactionType;
use App\Models\User;

class UserPermissionService
{

    function getDefaultUserPermissionsForUserType($userType)
    {
        if ($userType == UserType::Customer)
            return [
                'fund_request' => true,
                'bank_withdrawal' => true,
                'bill_payment' => true,
                'deposit' => true,
            ];
        if ($userType == UserType::Merchant)
            return [
                'fund_request' => true,
                'bank_withdrawal' => true,
                'bill_payment' => true,
                'deposit' => false,
            ];
        if ($userType == UserType::Biller)
            return [
                'fund_request' => false,
                'bank_withdrawal' => false,
                'bill_payment' => false,
                'deposit' => false,
            ];
        if ($userType == UserType::Agent)
            return [
                'fund_request' => false,
                'bank_withdrawal' => false,
                'bill_payment' => false,
                'deposit' => true,
            ];
        if ($userType == UserType::SubAccount)
            return [
                'fund_request' => true,
                'bank_withdrawal' => false,
                'bill_payment' => false,
                'deposit' => false,
            ];

    }

    function update_user_permission(User $user, $permissions)
    {
        $user->user_permission->update($permissions);

    }


    function authorizeUserPermission(User $user, $feature)
    {
        $perm = $user->user_permission;
        if ($perm->$feature)
            return true;
        return false;

    }

}