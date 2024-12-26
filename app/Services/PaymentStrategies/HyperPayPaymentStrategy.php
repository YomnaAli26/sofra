<?php

namespace App\Services\PaymentStrategies;

use Omnipay\Omnipay;

class HyperPayPaymentStrategy implements PaymentStrategyInterface
{
    private $gateway;
    public function __construct()
    {
        $this->gateway = Omnipay::create('Hyperpay');
        $this->gateway->setAccessToken(config('services.hyperpay.access_token'));
        $this->gateway->setEntityId(config('services.hyperpay.entity_id'));
        $this->gateway->setTestMode(config('services.hyperpay.sandbox'));

    }


    public function pay(int $payableId, int $userableId, string $currency, string $returnUrl, string $cancelUrl)
    {
        // TODO: Implement pay() method.
    }
}
