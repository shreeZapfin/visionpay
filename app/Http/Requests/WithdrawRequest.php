<?php

namespace App\Http\Requests;

use App\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class WithdrawRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->user_type_id == UserType::Agent)
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
            'user_id' => [
                Rule::exists('users','id')->where('user_type_id',  [UserType::Customer, UserType::Merchant])
                , 'not_in:' . $this->user()->id . ',' . UserType::Admin
            ],
            'transaction_pin' => 'required|digits:4'
        ];
    }
}
