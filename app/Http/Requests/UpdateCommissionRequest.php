<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCommissionRequest extends FormRequest
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
            'restaurant_id' => ['sometimes', 'integer', 'exists:restaurants,id'],
            'paid' => ['sometimes', 'numeric'],
            'notes' => ['nullable', 'string'],
            'date' => ['sometimes', 'date', 'date_format:Y-m-d'],
        ];
    }
}
