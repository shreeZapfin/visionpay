<?php

namespace App\Http\Requests;

use App\Helpers\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (in_array($this->user_type_id, \App\Enums\UserType::StaffTypes())) {
            if (Auth::user() == null)
                return false;
            if (!Auth::user()->is_admin)
                return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if ($this->method() == 'POST') {
            return [
                'mobile_no' => ['required', 'digits_between:7,10', 'unique:users,mobile_no'],
                'email' => 'required|email|unique:users,email',
                'username' => 'required|unique:users,username',
                'password' => [
                    'required',
                    'string',
                    Password::min(8)
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(),
                    'confirmed'
                ],
                'user_type_id' => ['required',Rule::exists('user_types','id')
                    ->where(function ($query) {
                    return $query->whereNotIn('id', \App\Enums\UserType::UniqueAdminTypes() + [\App\Enums\UserType::StaffTypes()]); #SINCE REGISTRATION IS OPEN DISALLOW REGISTRATION OF AGENT AND STAFF ACCOUNTS
                }),],
                'city_id' => 'nullable|exists:cities,id',
                'first_name' => 'nullable|alpha',
                'last_name' => 'nullable|alpha',
                'date_of_birth' => 'nullable|date_format:Y-m-d',
                'gender' => 'nullable|in:MALE,FEMALE,TRANSGENDER',
                'address' => 'nullable',
                'selfie_img' => 'nullable|image',
                'kyc_document_img' => 'required_with:kyc_document_type|image',
                'kyc_document_type' => 'required_with:kyc_document_img|in:PASSPORT,VOTERID,DRIVING_LICENSE',
                /*user_type_id 3:Agent ,4:Merchant*/
                'merchant_category_id' => 'required_if:user_type_id,3,4|exists:merchant_categories,id',
                'business_type_id' => 'required_if:user_type_id,3,4|exists:business_types,id',
                'business_name' => 'required_if:user_type_id,3,4|regex:/^[a-zA-Z0-9\s.-]+$/',
                'company_tin_no' => 'required_if:user_type_id,3,4|digits:9',
                'device_name' => 'required',
                /*user_type_id 5:Biller*/
                'biller_name' => 'required_if:user_type_id,5',
                "biller_fields.fields" => "required_if:user_type_id,5|array",
                'biller_img' => 'nullable|image',
                'biller_img_base64' => 'nullable',
                'biller_category_id' => 'required_if:user_type_id,5|exists:biller_categories,id',
                'personal_tin_no' => 'nullable',
                'source_of_income_id' => 'nullable|exists:source_of_income,id'
            ];
        }

        if ($this->method() == 'PATCH') {

            return [
                'mobile_no' => ['nullable', 'digits:7', 'unique:users,mobile_no'],
                'email' => 'nullable|email|unique:users,email',
                'username' => 'nullable|unique:users,username',
                'user_type_id' => 'nullable|exists:user_types,id',
                'city_id' => 'nullable|exists:cities,id',
                'first_name' => 'nullable|alpha',
                'last_name' => 'nullable|alpha',
                'date_of_birth' => 'nullable|date_format:Y-m-d',
                'gender' => 'nullable|in:MALE,FEMALE,TRANSGENDER',
                'address' => 'nullable',
                'transaction_pin' => 'nullable|confirmed|digits:4',
                'is_kyc_verified' => 'nullable|boolean',
                /*user_type_id 3:Agent ,4:Merchant*/
                'merchant_category_id' => 'nullable|exists:merchant_categories,id',
                'business_type_id' => 'nullable|exists:business_types,id',
                'company_tin_no' => 'nullable|alpha_num',
                'business_name' => 'nullable',
                'transfer_limit_scheme_id' => 'nullable|exists:transfer_limit_schemes,id',
                'commission_scheme_id' => 'nullable|exists:commission_schemes,id',
                'payment_link' => 'nullable',
                'qr_code_info' => 'nullable',
                'payment_charge_package_id' => 'nullable|exists:payment_charge_packages,id',
                'user_permissions' => 'nullable|array',
                'user_permissions.*' => 'boolean',
                'has_sub_accounts' => 'nullable|boolean',
                'personal_tin_no' => 'nullable',
                'remove_account_identifier' => 'nullable|boolean',
                'remove_account_remark' => 'nullable',
                'source_of_income_id' => 'nullable|exists:source_of_income,id',
                'wallet_limit' => 'nullable|numeric'
            ];
        }
    }

}
