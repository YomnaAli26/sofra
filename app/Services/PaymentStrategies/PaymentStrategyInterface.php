<?php

namespace App\Services\PaymentStrategies;

interface PaymentStrategyInterface
{
    public function pay(float $amount, string $currency, string $returnUrl, string $cancelUrl);
}
