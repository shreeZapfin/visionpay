<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SubAccountCollectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->is_sub_account)
            if($this->route('user')->id == Auth::user()->id)
                return true;



        if (Auth::user()->has_sub_accounts)
            if ($this->route('user')->master_account_user_id == Auth::user()->id)
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
