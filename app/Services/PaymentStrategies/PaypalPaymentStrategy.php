<?php

namespace App\Services\PaymentStrategies;


use Omnipay\Omnipay;


 class PaypalPaymentStrategy implements PaymentStrategyInterface
{
    public $gateway;
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(config('paypal.client_id'));
        $this->gateway->setSecret(config('paypal.secret'));
        $this->gateway->setTestMode(true);

    }

    public function pay(float $amount, string $currency, string $returnUrl, string $cancelUrl)
    {
        dd("Dd");
        $response = $this->gateway->purchase([
            'amount' => $amount,
            'currency' => $currency,
            'returnUrl' => $returnUrl,
            'cancelUrl' => $cancelUrl,
        ]);
        return $response->send();

    }
}
