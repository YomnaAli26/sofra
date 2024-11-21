<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation(): void
    {
        $this->merge(['restaurant_id' => auth('restaurant')->user()->id]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> ['sometimes', 'string','min:3'],
            'description'=>['sometimes', 'string','min:10'],
            'price' => ['sometimes', 'numeric', 'min:1'],
            'offer_price' => ['sometimes', 'numeric', 'min:1'],
            'restaurant_id' => ['required', 'exists:restaurants,id'],
            'preparation_time' => ['sometimes', 'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            'image'=> ['sometimes', 'image'],
        ];
    }
}
