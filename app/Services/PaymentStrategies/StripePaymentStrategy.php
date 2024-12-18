<?php

namespace App\Services\PaymentStrategies;

class StripePaymentStrategy implements PaymentStrategyInterface
{

    public function pay(float $amount, string $currency, string $returnUrl, string $cancelUrl): bool
    {
        // TODO: Implement pay() method.
    }
}
