<?php

namespace App\Rules;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidOrderStatus implements ValidationRule
{
    protected OrderStatusEnum $currentStatus;
    public function __construct(protected $orderId)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $order = Order::query()->find($this->orderId);
        if (!$order)
        {
            $fail("invalid order id");
            return;
        }
        $this->currentStatus = $order->status;
        if ($this->currentStatus == OrderStatusEnum::DELIVERED  && $value == 'canceled')
        {
            $fail("A delivered order cannot be canceled.");
            return;

        }
        if ($this->currentStatus == OrderStatusEnum::CANCELED  && $value == 'delivered')
        {
            $fail("A canceled order cannot be delivered.");


        }


    }
}
