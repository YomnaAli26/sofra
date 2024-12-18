<?php

namespace App\Http\Requests\Role;

use Illuminate\Validation\Rule;

class UpdateRoleRequest
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
    public function rules($id): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255',Rule::unique('roles','name')->ignore($id)],
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => ['sometimes','string', 'exists:permissions,name'],
        ];
    }
}
