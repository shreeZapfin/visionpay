<?php

/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 09-Jul-21
 * Time: 1:13 AM
 */

namespace App\Services;

use App;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserService
{

    function addUser($userDetailsArray): App\Models\User
    {
        $user = new App\Models\User();

        /*Mandatory*/
        $user->mobile_no = isset($userDetailsArray['mobile_no']) ? $userDetailsArray['mobile_no'] : null;
        $user->email = isset($userDetailsArray['email']) ? $userDetailsArray['email'] : null;
        $user->username = $userDetailsArray['username'];
        $user->password = bcrypt($userDetailsArray['password']);
        $user->user_type_id = $userDetailsArray['user_type_id'];
        $user->wallet_id = $user->Wallet()->create()->id;
        $defaultUserPermissionsForUserType = (new UserPermissionService())->getDefaultUserPermissionsForUserType($userDetailsArray['user_type_id']);
        $user->user_permission_id = $user->user_permission()->create($defaultUserPermissionsForUserType)->id;

        /*Optional*/
        $user->city_id = isset($userDetailsArray['city_id']) ? $userDetailsArray['city_id'] : null;
        $user->first_name = isset($userDetailsArray['first_name']) ? $userDetailsArray['first_name'] : null;
        $user->last_name = isset($userDetailsArray['last_name']) ? $userDetailsArray['last_name'] : null;
        $user->date_of_birth = isset($userDetailsArray['date_of_birth']) ? $userDetailsArray['date_of_birth'] : null;
        $user->gender = isset($userDetailsArray['gender']) ? $userDetailsArray['gender'] : null;
        $user->address = isset($userDetailsArray['address']) ? $userDetailsArray['address'] : null;
        $user->personal_tin_no = isset($userDetailsArray['personal_tin_no']) ? $userDetailsArray['personal_tin_no'] : null;

        /*Storage*/
        $user->selfie_img_url = isset($userDetailsArray['selfie_img']) ? (new App\Helpers\FileHelper())->storeFileOnS3($userDetailsArray['selfie_img'], 'selfie_images') : null;
        $user->kyc_document_url = isset($userDetailsArray['kyc_document_img']) ? (new App\Helpers\FileHelper())->storeFileOnS3($userDetailsArray['kyc_document_img'], 'kyc_documents') : null;
        $user->kyc_document_type = isset($userDetailsArray['kyc_document_type']) ? $userDetailsArray['kyc_document_type'] : null;

        if ($userDetailsArray['user_type_id'] == App\Enums\UserType::SubAccount) { /*Mark sub account defaults*/
            $user->master_account_user_id = $userDetailsArray['master_account_user_id'];
            $user->is_kyc_verified = true;
            $user->is_registration_completed = true;
            $user->is_verified = true;
            $user->first_name = 'Sub account';
            $user->last_name = $userDetailsArray['username'];
        }
        $user->save();
        $user->pacpay_user_id = 'PP-' . date('y') . '-' . $user->id;
        $user->qr_code_info = 'https://pacpay.com/app?action=send&user_id=' . $user->id;

        /*If merchant*/

        if (in_array($userDetailsArray['user_type_id'], [App\Enums\UserType::Agent, App\Enums\UserType::Merchant])) {
            $business = $user->business()->firstOrNew();
            $business->business_name = $userDetailsArray['business_name'];
            $business->business_type_id = $userDetailsArray['business_type_id'];
            $business->company_tin_no = $userDetailsArray['company_tin_no'];
            $business->merchant_category_id = $userDetailsArray['merchant_category_id'];
            $business->save();

            if ($userDetailsArray['user_type_id'] == App\Enums\UserType::Agent) {
                $agent = $user->agent()->firstOrCreate();
                $agent->agentWallets()->create(['wallet_type' => 'FUNDS']);
                $agent->agentWallets()->create(['wallet_type' => 'COMMISSION']);
            }
        }

        /*If biller*/
        if (in_array($userDetailsArray['user_type_id'], [App\Enums\UserType::Biller])) {
            foreach ($userDetailsArray['biller_fields']['fields'] as &$field) {
                if (!isset($field['check_regex'])) {
                    $field['check_regex'] = false;
                }
                if ($field['check_regex'] == '1')
                    $field['check_regex'] = true;
                else
                    $field['check_regex'] = false;
            }

            array_push($userDetailsArray['biller_fields']['fields'], ['name' => 'amount', 'check_regex' => true, 'regex' => '[0-9]+']);
            $user->biller()->firstOrCreate([
                'biller_name' => $userDetailsArray['biller_name'],
                'biller_fields' => $userDetailsArray['biller_fields'],
                'biller_img_url' => isset($userDetailsArray['biller_img'])
                    ? (new App\Helpers\FileHelper())->storeFileOnS3($userDetailsArray['biller_img'], 'biller_logos')
                    : ((isset($userDetailsArray['biller_img_base64'])) ? (new App\Helpers\FileHelper())->storeBase64FileOnS3($userDetailsArray['biller_img_base64'], 'biller_logos')
                        : null),
                'biller_category_id' => $userDetailsArray['biller_category_id'],
            ]);
        }
        (new PaymentChargePackageService())->assignUserDefaultPaymentChargePackage($user);
        $user->save(); /*Calls observer to check business detail completion*/

        return $user;
    }


    function updateUser($user, $userDetailsArray): App\Models\User
    {


        DB::transaction(function () use ($user, $userDetailsArray) {
            /*User profile*/
            $user->mobile_no = isset($userDetailsArray['mobile_no']) ? $userDetailsArray['mobile_no'] : $user->mobile_no;
            $user->email = isset($userDetailsArray['email']) ? $userDetailsArray['email'] : $user->email;
            $user->username = isset($userDetailsArray['username']) ? $userDetailsArray['username'] : $user->username;
            //            $user->user_type_id = isset($userDetailsArray['user_type_id']) ? $userDetailsArray['user_type_id'] : $user->user_type_id;
            $user->city_id = isset($userDetailsArray['city_id']) ? $userDetailsArray['city_id'] : $user->city_id;
            $user->first_name = isset($userDetailsArray['first_name']) ? $userDetailsArray['first_name'] : $user->first_name;
            $user->last_name = isset($userDetailsArray['last_name']) ? $userDetailsArray['last_name'] : $user->last_name;
            $user->date_of_birth = isset($userDetailsArray['date_of_birth']) ? $userDetailsArray['date_of_birth'] : $user->date_of_birth;
            $user->gender = isset($userDetailsArray['gender']) ? $userDetailsArray['gender'] : $user->gender;
            $user->address = isset($userDetailsArray['address']) ? $userDetailsArray['address'] : $user->address;
            $user->personal_tin_no = isset($userDetailsArray['personal_tin_no']) ? $userDetailsArray['personal_tin_no'] : null;

            $user->payment_link = isset($userDetailsArray['payment_link']) ? $userDetailsArray['payment_link'] : $user->payment_link;
            $user->qr_code_info = isset($userDetailsArray['qr_code_info']) ? $userDetailsArray['qr_code_info'] : $user->qr_code_info;


            /*If update business*/
            if (in_array($user->user_type_id, [App\Enums\UserType::Agent, App\Enums\UserType::Merchant])) {
                $business = $user->business()->firstOrNew();
                $business->business_name = isset($userDetailsArray['business_name']) ? $userDetailsArray['business_name'] : $business->business_name;
                $business->business_type_id = isset($userDetailsArray['business_type_id']) ? $userDetailsArray['business_type_id'] : $business->business_type_id;
                $business->merchant_category_id = isset($userDetailsArray['merchant_category_id']) ? $userDetailsArray['merchant_category_id'] : $business->merchant_category_id;
                $business->save();
            }

            /*User settings*/
            if (!isset($user->transaction_pin)) /*Only allow to patch transaction pin first time*/
                if (isset($userDetailsArray['transaction_pin']))
                    $user->transaction_pin = bcrypt($userDetailsArray['transaction_pin']);

            if (Auth::user()->is_admin) { /*Admin can edit user settings*/
                $user->commission_scheme_id = isset($userDetailsArray['commission_scheme_id']) ? $userDetailsArray['commission_scheme_id'] : $user->commission_scheme_id;

                if (isset($userDetailsArray['transfer_limit_scheme_id']))
                    if (App\Helpers\Utils::is_transfer_limit_scheme_change_possible($user, App\Models\TransferLimitScheme::find($userDetailsArray['transfer_limit_scheme_id'])))
                        $user->transfer_limit_scheme_id = $userDetailsArray['transfer_limit_scheme_id'];

                if (isset($userDetailsArray['user_permissions'])) {
                    (new UserPermissionService())->update_user_permission($user, $userDetailsArray['user_permissions']);
                }
                $user->has_sub_accounts = isset($userDetailsArray['has_sub_accounts']) ? $userDetailsArray['has_sub_accounts'] : $user->has_sub_accounts;

                if (isset($userDetailsArray['remove_account_identifier']))
                    if ($userDetailsArray['remove_account_identifier']) {

                        $oldDetails = $user->only('mobile_no', 'username', 'email');

                        (new UserEventService($user))->createEvent([
                            'remark' => $userDetailsArray['remove_account_remark'],
                            'event' => 'ACCOUNT_IDENTIFIER_REMOVED',
                            'action_user_id' => Auth::user()->id,
                            'data' => $oldDetails
                        ]);

                        $user->mobile_no = null;
                        $user->email = null;
                        $user->username = null;
                        $user->tokens()->delete();
                    }
            }

            if (in_array(Auth::user()->user_type_id, [App\Enums\UserType::Agent, App\Enums\UserType::Admin])) /*Agent or admin can mark user as verified*/ {
                $user->is_kyc_verified = isset($userDetailsArray['is_kyc_verified']) ? $userDetailsArray['is_kyc_verified'] : $user->is_kyc_verified;
                $user->kyc_verified_by = Auth::user()->id;
                $user->kyc_verified_at = now();
            }
        });


        $user->save(); /*Calls observer to check business detail completion*/

        if (isset($userDetailsArray['payment_charge_package_id'])) {
            (new PaymentChargePackageService())->assignUserPaymentChargePackage($user, App\Models\PaymentChargePackage::find($userDetailsArray['payment_charge_package_id']));
            if ($user->has_sub_accounts) (new SubAccountService($user))->updateSubAccounts(['payment_charge_package_id' => $userDetailsArray['payment_charge_package_id']]);
        }
        return $user;
    }

    function getUserIdsByUserType($userTypeId): array
    {
        return App\Models\User::where('user_type_id', $userTypeId)->select('id')->get()->pluck('id')->toArray();
    }

    function getFcmTokensByUserType($userTypeId): array
    {
        return App\Models\FcmToken::whereHas('User', function ($q) use ($userTypeId) {
            $q->where('user_type_id', $userTypeId);
        });
    }
}
