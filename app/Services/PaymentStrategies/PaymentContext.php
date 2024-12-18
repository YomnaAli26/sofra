<?php
namespace App\Services\PaymentStrategies;

class PaymentContext
{
    public PaymentStrategyInterface $paymentStrategy;

    public function setStrategy(PaymentStrategyInterface $paymentStrategy): PaymentContext
    {
        $this->paymentStrategy = $paymentStrategy;
        return $this;
    }

    public function executePayment(float $amount, string $currency, string $returnUrl, string $cancelUrl)
    {
        return $this->paymentStrategy->pay($amount, $currency, $returnUrl, $cancelUrl);
    }

    public function processSuccessPayment($paymentId, $payerId)
    {
        return $this->paymentStrategy->success($paymentId, $payerId);
    }
}
