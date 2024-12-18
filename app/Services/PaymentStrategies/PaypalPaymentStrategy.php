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

     /**
      * @throws \Exception
      */
     public function pay(float $amount, string $currency, string $returnUrl, string $cancelUrl)
    {
        $response = $this->gateway->purchase([
            'amount' => $amount,
            'currency' => $currency,
            'returnUrl' => $returnUrl,
            'cancelUrl' => $cancelUrl,
        ]);
        $response = $response->send();
        if ($response->isSuccessful() && $response->isRedirect()) {
            return $response->getData()['links'][1]['href'];

        }
        else
        {
            throw new \Exception("Payment failed: " . $response->getMessage());
        }


    }

}
