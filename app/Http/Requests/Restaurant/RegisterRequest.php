<?php

namespace App\Http\Requests\Restaurant;

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
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:restaurants,email'],
            'phone' => ['required', 'string', 'min:11', 'max:11', 'unique:restaurants,phone'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'area_id' => ['required', 'exists:areas,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image'],
            'min_order' => ['required', 'integer', 'min:1'],
            'delivery_fee' => ['required', 'integer', 'min:1'],
            'contact_phone' => ['required', 'string', 'min:11', 'max:11', 'unique:restaurants,contact_phone'],
            'whatsapp_number' => ['required', 'string', 'min:11', 'max:11', 'unique:restaurants,whatsapp_number'],
        ];
    }
}
