<?php

namespace App\Http\Requests;

use App\Enums\FeatureType;
use App\Enums\UserType;
use App\Services\UserPermissionService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateFundRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ((new UserPermissionService())->authorizeUserPermission(Auth::user(), FeatureType::FUND_REQUEST))
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
        return [
            'amount' => 'required|numeric',
            'is_wallet_refill' => 'required|boolean',
            'request_to' => ['required_if:is_wallet_refill,false', 'not_in:' . $this->user()->id . ',' . UserType::Admin, Rule::exists('users', 'id')->where('user_type_id', [UserType::Customer, UserType::Merchant])],
            'admin_bank_id' => 'nullable|required_if:is_wallet_refill,true|exists:admin_bank_details,id',
            'bank_txn_id' => 'required_if:is_wallet_refill,true',
            'description' => 'nullable'
        ];
    }
}
