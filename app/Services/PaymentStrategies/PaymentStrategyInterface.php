<?php

namespace App\Services\PaymentStrategies;

interface PaymentStrategyInterface
{
    public function pay(int $payableId, int $userableId, string $currency, string $returnUrl, string $cancelUrl);
}
