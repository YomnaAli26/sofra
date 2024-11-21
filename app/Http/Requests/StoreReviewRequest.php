<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        return $this->merge(['client_id' => auth('client')->user()->id]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'review'=> ['required', 'string','min:3'],
            'rate'=>['required', 'integer','min:1','max:5'],
            'restaurant_id' => ['required', 'exists:restaurants,id'],
            'client_id' => ['required', 'exists:clients,id'],


        ];
    }
}
