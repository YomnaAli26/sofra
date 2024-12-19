<?php

namespace App\Services\PaymentStrategies;

interface PaymentStrategyInterface
{
    public function pay(int $payableId, string $currency, string $returnUrl, string $cancelUrl);
}
