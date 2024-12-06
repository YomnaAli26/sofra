<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCommissionRequest extends FormRequest
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
           'restaurant_id' => ['required', 'integer', 'exists:restaurants,id'],
            'paid' => ['required', 'numeric'],
            'notes' => ['nullable', 'string'],
            'date' => ['required', 'date', 'date_format:Y-m-d'],

        ];
    }
}
