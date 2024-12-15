<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreRoleRequest

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
            'name' => ['required', 'string', 'max:255',Rule::unique('roles','name')],
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => ['sometimes','string', 'exists:permissions,name'],
        ];
    }
}
