<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGlobalSiteSettingsRequest extends FormRequest
{
    protected $errorBag = 'siteSettings';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'registration_enabled' => ['required', 'boolean'],
            'show_home_page' => ['required', 'boolean']
        ];
    }
}
