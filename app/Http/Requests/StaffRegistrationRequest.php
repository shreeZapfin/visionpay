<?php

namespace App\Http\Requests;

use App\Helpers\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StaffRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->is_admin)
            return true;
        return false;
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
                'user_type_id' => ['required', 'in:' . UserType::Staff],
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
                'personal_tin_no' => 'nullable',
                'source_of_income_id' => 'nullable|exists:source_of_income,id'
            ];
        }

    }

}
