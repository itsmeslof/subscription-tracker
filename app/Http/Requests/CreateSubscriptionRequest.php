<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubscriptionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'billing_cycle_id' => ['required', 'exists:billing_cycles,id'],
            'color' => ['required', 'string', 'size:7']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'amount' => str_replace(',', '', $this->amount)
        ]);
    }
}
