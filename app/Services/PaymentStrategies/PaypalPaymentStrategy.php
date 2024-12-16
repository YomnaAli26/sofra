<?php

namespace App\Services\PaymentStrategies;

use AllowDynamicProperties;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

#[AllowDynamicProperties] class PaypalPaymentStrategy implements PaymentStrategyInterface
{
    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(config('paypal.client_id'), config('paypal.secret'))
        );
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function pay(float $amount): bool
    {
        // TODO: Implement pay() method.
    }
}
