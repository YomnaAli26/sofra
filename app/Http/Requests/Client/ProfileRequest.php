<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('clients','email')->ignore(auth('client')->user()->id)],
            'phone' => ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('clients','phone')->ignore(auth('client')->user()->id)],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
            'area_id' => ['sometimes', 'exists:areas,id'],
        ];
    }
}
