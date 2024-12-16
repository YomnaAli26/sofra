<?php

namespace App\Services\PaymentStrategies;

interface PaymentStrategyInterface
{
    public function pay(float $amount): bool;
}
