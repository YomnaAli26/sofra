<?php

namespace App\Http\Requests\Client;

use App\Enums\ContactStatusEnum;
use App\Enums\RestaurantStatusEnum;
use App\Models\Restaurant;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
        $this->merge(['client_id' => auth('client')->user()->id]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'notes' => ['nullable', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'payment_method' => ['required', 'string', 'max:255'],
            'meals' => ['required', 'array'],
            'meals.*.meal_id' => ['required', 'integer', 'exists:meals,id'],
            'meals.*.quantity' => ['required', 'integer', 'min:1'],
            'meals.*.special_request' => ['nullable', 'string', 'max:255'],
            'restaurant_id' => ['required', 'integer', 'exists:restaurants,id', function ($attribute, $value, $fail) {
                $restaurant = Restaurant::query()->find($value);
                if ($restaurant && $restaurant->status == RestaurantStatusEnum::CLOSED) {
                    return $fail(__('validation.restaurant_not_available'));
                }
            }],
            'client_id' => ['required', 'integer', 'exists:clients,id'],
        ];
    }
}
