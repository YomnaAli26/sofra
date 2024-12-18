<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRestaurantRequest extends FormRequest
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
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('restaurants','email')
            ->ignore(request()->route('restaurant'))],
            'phone' => ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('restaurants','phone')
                ->ignore(request()->route('restaurant'))],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
            'area_id' => ['sometimes', 'exists:areas,id'],
            'category_id' => ['sometimes', 'exists:categories,id'],
            'image' => ['sometimes', 'image'],
            'min_order' => ['sometimes', 'integer', 'min:1'],
            'delivery_fee' => ['sometimes', 'integer', 'min:1'],
            'contact_phone' => ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('restaurants','contact_phone')
                ->ignore(request()->route('restaurant'))],
            'whatsapp_number' => ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('restaurants','whatsapp_number')
                ->ignore(request()->route('restaurant'))],
        ];
    }
}
