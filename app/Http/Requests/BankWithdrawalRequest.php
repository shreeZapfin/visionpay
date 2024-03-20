<?php

namespace App\Http\Requests;

use App\Enums\FeatureType;
use App\Enums\UserType;
use App\Services\UserPermissionService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BankWithdrawalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (in_array(Auth::user()->user_type_id, [UserType::Merchant, UserType::Customer, UserType::Agent, UserType::Biller]))
            if ((new UserPermissionService())->authorizeUserPermission(Auth::user(), FeatureType::BANK_WITHDRAWAL))
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
            'amount' => 'required|numeric|min:10',
            'transaction_pin' => 'required|digits:4',
            'user_bank_id' => 'required|exists:user_banks,id,user_id,' . Auth::user()->id
        ];
    }
}
