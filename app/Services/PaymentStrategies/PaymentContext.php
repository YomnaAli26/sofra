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

    public function executePayment(int $payableId , int $userableId, string $currency, string $returnUrl, string $cancelUrl)
    {
        return $this->paymentStrategy->pay($payableId, $userableId, $currency, $returnUrl, $cancelUrl);
    }

    public function processSuccessPayment($requestData)
    {
        return $this->paymentStrategy->success($requestData);
    }
}
