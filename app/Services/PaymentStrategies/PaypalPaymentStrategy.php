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
            return response()->apiResponse(data: ['redirect_url' => $response->getData()['links'][1]['href']]);

        } else {
            throw new \Exception("Payment failed: " . $response->getMessage());
        }


    }

    public function success($paymentId, $payerId)
    {

        $response = $this->gateway->completePurchase([
            'transactionReference' => $paymentId,
            'payer_id' => $payerId,
        ])->send();
        dd($response);
        // Check if the payment was successful
        if ($response->isSuccessful()) {
            // Payment successful, handle accordingly
            $transactionData = $response->getData();
            return response()->json([
                'success' => true,
                'message' => 'Payment completed successfully',
                'transaction_data' => $transactionData,
            ]);
        } else {
            // Payment failed
            throw new \Exception("Payment failed: " . $response->getMessage());
        }

    }


}
