<?php

namespace App\Http\Requests;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SearchUserRequest extends FormRequest
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
            'search' => [Rule::requiredIf(function () {
                if (in_array(Auth::user()->user_type_id,[UserType::Staff,UserType::Admin]) || $this->has('id'))
                    return false;
                return true;
            })],
            'id' => 'nullable'
        ];
    }
}
