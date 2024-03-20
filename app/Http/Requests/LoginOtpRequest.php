<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginOtpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'username' => 'required',
            'otp' => 'required',
            'device_name' => 'required',
            'sent_otp_to' => 'required|in:email,mobile_no'
        ];
    }
}
