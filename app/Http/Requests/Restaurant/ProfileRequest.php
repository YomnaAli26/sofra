<?php

namespace App\Http\Requests\Restaurant;

use App\Enums\RestaurantStatus;
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
            'email' => ['sometimes', 'string', 'email', 'max:255',  Rule::unique('restaurants','email')->ignore(auth('restaurant')->user()->id)],
            'phone' => ['sometimes', 'string', 'min:11', 'max:11',  Rule::unique('restaurants','email')->ignore(auth('restaurant')->user()->id)],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
            'area_id' => ['sometimes', 'exists:areas,id'],
            'category_id' => ['sometimes', 'exists:categories,id'],
            'image' => ['sometimes', 'image'],
            'min_order' => ['sometimes', 'integer', 'min:1'],
            'delivery_fee' => ['sometimes', 'integer', 'min:1'],
            'contact_phone' => ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('restaurants','contact_phone')->ignore(auth('restaurant')->user()->id)],
            'whatsapp_number' => ['sometimes', 'string', 'min:11', 'max:11', Rule::unique('restaurants','whatsapp_number')->ignore(auth('restaurant')->user()->id)],
            'status'=>['sometimes','string','in:'.implode(',',array_map(fn($case)=> $case->value, RestaurantStatus::cases()))],

        ];
    }
}
