<?php

namespace App\Http\Requests\Payment;

use App\Models\Commission;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payable_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                $existsOrders = Order::where('id', $value)->exists();
                $existsCommission = Commission::where('id', $value)->exists();
                if (!$existsOrders && !$existsCommission) {
                    $fail($attribute . ' must exist in either orders or commissions.');
                }
            }],
            'payable_type' => ['required', 'string', 'in:order,commission'],
            'currency' => ['required',],
        ];
    }

}
