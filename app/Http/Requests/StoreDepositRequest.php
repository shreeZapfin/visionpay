<?php

namespace App\Http\Requests;

use App\Enums\FeatureType;
use App\Enums\UserType;
use App\Services\UserPermissionService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreDepositRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->user_type_id == UserType::Agent || Auth::user()->hasTokenAbilityTo('agent-access'))
            if ((new UserPermissionService())->authorizeUserPermission(Auth::user(), FeatureType::DEPOSIT))
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
            'user_id' => [
                Rule::exists('users', 'id')->where('user_type_id', [UserType::Customer, UserType::Merchant])
                , 'not_in:' . $this->user()->id . ',' . UserType::Admin
            ],
            'description' => 'nullable',
            'transaction_pin' => 'required|digits:4'
        ];
    }
}
