<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAreaRequest extends FormRequest
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
            'name.en' => ['sometimes', 'string', 'min:3', 'max:255'],
            'name.ar' => ['sometimes', 'string', 'min:3', 'max:255'],
            'city_id' => ['sometimes', 'integer', 'exists:cities,id'],
        ];
    }
}
