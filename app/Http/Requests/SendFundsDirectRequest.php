<?php

namespace App\Http\Requests;

use App\Enums\FeatureType;
use App\Enums\Permissions;
use App\Enums\UserType;
use App\Models\User;
use App\Services\UserPermissionService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SendFundsDirectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->user_type_id == UserType::Staff)
            if(!Auth::user()->hasPermissionTo(Permissions::MANAGE_USER_WALLET))
                return false;


        if (!Auth::user()->is_admin) /*Only admin can send funds to agent*/ {
            if($this->has('is_wallet_refill'))
                return false;
            if (User::find($this->request->get('send_to'))->user_type_id == UserType::Agent)
                return false; /*Do not allow normal users to add balance to agents*/
            if (!(new UserPermissionService())->authorizeUserPermission(Auth::user(), FeatureType::FUND_REQUEST))
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
        return [
            'send_to' => 'required|exists:users,id|not_in:' . $this->user()->id . ',' . UserType::Admin,
            'transaction_pin' => 'required|digits:4',
            'amount' => 'required|numeric',
            'description' => 'nullable',
            'is_wallet_refill' => 'nullable|boolean',
            'is_agent_wallet_refill' => 'nullable|boolean'
        ];
    }
}
