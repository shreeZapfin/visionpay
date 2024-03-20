<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateVoucherRequest extends FormRequest
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
        return [
            'cashback_type' => 'required|in:PERCENTAGE,FIXED_AMOUNT',
            'expiry_date' => 'required|date_format:Y-m-d',
            'voucher_for' => 'required|in:FUND_REQUEST,DEPOSIT,BILL_PAYMENT'
        ];
    }
}
