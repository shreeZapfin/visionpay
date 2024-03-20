<?php

namespace App\Http\Requests;

use App\Enums\FeatureType;
use App\Enums\UserType;
use App\Services\UserPermissionService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BillPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (in_array(Auth::user()->user_type_id, [UserType::Merchant, UserType::Customer]))
            if ((new UserPermissionService())->authorizeUserPermission(Auth::user(), FeatureType::BILL_PAYMENT))
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
        $rules = [];

        $storedBillerFields = $this->route('biller')->biller_fields['fields'];

        foreach ($storedBillerFields as $key => $val) {

            $rules['biller_fields.fields.' . $key . '.name'] = 'required|in:' . $storedBillerFields[$key]['name'];
            $rules['biller_fields.fields.' . $key . '.value'] = 'required' . (isset($storedBillerFields[$key]['check_regex'])
                ? ($storedBillerFields[$key]['check_regex'] == true) ? '|regex:' . $storedBillerFields[$key]['regex']: '' : '');
        }
//        dd($rules);
        return $rules;

    }

    public function messages()
    {
        $messages = [];

        $storedBillerFields = $this->route('biller')->biller_fields['fields'];

        $requestFields = $this->request->get('biller_fields')['fields'];

        foreach ($storedBillerFields as $key => $val) {


            $messages['biller_fields.fields.' . $key . '.name.required'] = 'The field name ' . $storedBillerFields[$key]['name'] . ' is required';
            $messages['biller_fields.fields.' . $key . '.value.required'] = 'The field value of ' . $storedBillerFields[$key]['name'] . ' is invalid';
            $messages['biller_fields.fields.' . $key . '.name.in'] = 'The field name ' . (array_key_exists($key, $requestFields)
                    ?
                    $requestFields[$key]['name'] : ' Not present') . ' is invalid.Correct input name : ' . $storedBillerFields[$key]['name'];
            $messages['biller_fields.fields.' . $key . '.value.regex'] = 'The field value of ' . $storedBillerFields[$key]['name'] . ' is invalid';
        }
        return $messages;
    }
}
