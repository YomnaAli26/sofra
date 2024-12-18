<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
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
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('clients','email')
                ->ignore(request()->route('client'))],
            'phone' => ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('clients','phone')
                ->ignore(request()->route('client'))],
            'area_id' => ['sometimes', 'exists:areas,id'],
        ];
    }
}
