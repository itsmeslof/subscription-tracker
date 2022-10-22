<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIPRestrictionRequest extends FormRequest
{
    protected $errorBag = 'ipAccess';

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'restrict_ip_access' => ['required', 'boolean'],
            'allowed_ip' => ['required', 'string', 'ipv4']
        ];
    }
}
