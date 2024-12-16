<?php
namespace App\Services\PaymentStrategies;

class PaymentContext
{
    public function __construct(public PaymentStrategyInterface $paymentStrategy)
    {
    }

    public function setStrategy(PaymentStrategyInterface $paymentStrategy): void
    {
        $this->paymentStrategy = $paymentStrategy;
    }

    public function executePayment($amount): bool
    {
        return $this->paymentStrategy->pay($amount);
    }
}
