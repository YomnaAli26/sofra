<?php

namespace App\Http\Requests\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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
            'from' => ['required', 'date','before_or_equal:today'],
            'to' => ['required', 'date','after_or_equal:from'],
            'restaurant_id' => ['required', 'exists:restaurants,id'],
            'image'=> ['required', 'image'],

        ];
    }
}
