<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BillerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       if(Auth::user()->is_admin)
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
            'biller_name' => 'nullable',
            'biller_fields.fields.*' => 'nullable|array',
            'biller_category_id' => 'nullable|exists:biller_categories,id',
            'is_active' => 'nullable|boolean',
            'biller_img_base64' => 'nullable'
        ];
    }
}
