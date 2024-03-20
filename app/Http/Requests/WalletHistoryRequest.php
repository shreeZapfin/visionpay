<?php

namespace App\Http\Requests;

use App\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class WalletHistoryRequest extends FormRequest
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
            'from_date' => 'required_without_all:txn_id,search_user_id|date_format:Y-m-d',
            'to_date' => 'required_without_all:txn_id,search_user_id|date_format:Y-m-d',
            'user_id' => 'nullable|exists:users,id',
            'txn_type' => 'nullable',
            'txn_id' => 'nullable',
            'name' => 'nullable',
            'wallet_type' => 'nullable|in:COMMISSION,FUNDS',
            'data_for_analysis' => 'nullable|in:inflow_outflow',
            'date_period' => 'nullable|in:weekly,daily,monthly',
            'sub_account_user_id' => 'nullable|exists:users,id,master_account_user_id,'.Auth::user()->id,
            'search_user_id' => 'nullable'
        ];
    }
}
