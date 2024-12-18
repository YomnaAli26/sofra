<?php

namespace App\Services\PaymentStrategies;


use App\Models\PaymentTransaction;
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
    public function pay(int $payableId, string $currency, string $returnUrl, string $cancelUrl)
    {
        $payableType = ucfirst(request()->input('payable_type'));
        $payableModel = 'App\\Models\\' . $payableType;
        $payableModel = $payableModel::find($payableId);

        $userableModel = auth()->user();
        $response = $this->gateway->purchase([
            'amount' => $payableModel->total_amount,
            'currency' => $currency,
            'returnUrl' => $returnUrl,
            'cancelUrl' => $cancelUrl,
        ]);
        $response = $response->send();

        PaymentTransaction::create([
            'payable_id' => $payableModel->id,
            'payable_type' => get_class($payableModel),
            'userable_id' => $userableModel->id,
            'userable_type' => get_class($userableModel),
            'amount' => $payableModel->total_amount,
            'currency' => $currency,
            'payment_method' => 'paypal',
            'payment_gateway_data' => json_encode($response->getData()),


        ]);
        if ($response->isSuccessful() && $response->isRedirect()) {
            return response()->apiResponse(data: ['redirect_url' => $response->getData()['links'][1]['href']]);

        } else {
            throw new \Exception("Payment failed: " . $response->getMessage());
        }


    }

    public function success($requestData)
    {
        $paymentId = $requestData['paymentId'];
        $payerId = $requestData['PayerID'];

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
