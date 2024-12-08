<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $passwordRules = ['required', 'string', 'min:8',];
        if (!request()->routeIs('admin.*'))$passwordRules[] = 'confirmed';
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients,email'],
            'phone' => ['required', 'string', 'min:11', 'max:11', 'unique:clients,phone'],
            'password' => $passwordRules,
            'area_id' => ['required', 'exists:areas,id'],
        ];
    }
}
