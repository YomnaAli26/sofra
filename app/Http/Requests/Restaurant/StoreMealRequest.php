<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class StoreMealRequest extends FormRequest
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
            'name'=> ['required', 'string','min:3'],
            'description'=>['required', 'string','min:10'],
            'price' => ['required', 'numeric', 'min:1'],
            'offer_price' => ['required', 'numeric', 'min:1'],
            'restaurant_id' => ['required', 'exists:restaurants,id'],
            'preparation_time' => ['required', 'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            'image'=> ['required', 'image'],

        ];
    }
}
