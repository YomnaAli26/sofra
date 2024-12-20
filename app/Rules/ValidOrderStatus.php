<?php

namespace App\Rules;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidOrderStatus implements ValidationRule
{


    public function __construct(protected $orderId, protected array $statusSupport)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $order = Order::query()->find($this->orderId);
        if (!$order) {
            $fail("invalid order id");
            return;
        }


        if (!in_array($order->status, $this->statusSupport)) {
            $fail("invalid order status. Status should be " . implode('or ', array_map(fn($status) => $status->value, $this->statusSupport)));
        }


    }
}
