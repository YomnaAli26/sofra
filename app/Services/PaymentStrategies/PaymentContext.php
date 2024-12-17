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

    public function executePayment(float $amount, string $currency, string $returnUrl, string $cancelUrl)
    {
        return $this->paymentStrategy->pay($amount, $currency, $returnUrl, $cancelUrl);
    }
}
