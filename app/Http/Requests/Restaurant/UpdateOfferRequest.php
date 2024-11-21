<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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
            'from' => ['sometimes', 'date','before_or_equal:today'],
            'to' => ['sometimes', 'date','after_or_equal:from'],
            'restaurant_id' => ['required', 'exists:restaurants,id'],
            'image'=> ['sometimes', 'image'],

        ];
    }
}
