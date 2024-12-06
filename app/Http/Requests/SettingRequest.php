<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'alahly_account_number' => [
                'required',
                'string',
                'regex:/^[0-9]+$/',
                'max:20',
            ],
            'alraghy_account_number' => [
                'required',
                'string',
                'regex:/^[0-9]+$/',
                'max:20',
            ],
            'commission_value' => [
                'required',
                'numeric',
                'min:0',
            ],
            'commission_details' => [
                'required',
                'string',
                'max:500',
            ],
            'who_us' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

}
