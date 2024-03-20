<?php

namespace App\Http\Requests;

use App\Enums\UserType;
use App\Services\WithdrawalService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AcceptWithDrawRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (in_array(Auth::user()->user_type_id, [UserType::Merchant, UserType::Customer]))
            if($this->route('withdrawal')->user_id == Auth::user()->id)
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
            'transaction_pin' => 'required|digits:4',
        ];
    }
}
