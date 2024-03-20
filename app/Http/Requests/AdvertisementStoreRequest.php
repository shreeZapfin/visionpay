<?php

namespace App\Http\Requests;

use App\Enums\Permissions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdvertisementStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->is_admin || Auth::user()->hasPermissionTo(Permissions::MANAGE_ADVERTISEMENT))
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
            'title' => 'required|string',
            'advertisement_type' => 'in:IMAGE,TEXT',
            'advertisement_image' => 'nullable|required_if:advertisement_type,IMAGE|image',
            'body' => 'nullable|string',
            'redirect_to' => 'in:APP,WEB,NONE',
            'redirect_app' => 'nullable|required_if:redirect_to,APP',
            'redirect_web_url' => 'nullable|required_if:redirect_to,WEB|url',
        ];
    }
}
