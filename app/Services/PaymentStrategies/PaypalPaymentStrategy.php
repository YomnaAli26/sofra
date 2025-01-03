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
    public function pay(int $payableId,int $userableId, string $currency, string $returnUrl, string $cancelUrl)
    {

        $payableType = ucfirst(request()->input('payable_type'));
        $payableModel = 'App\\Models\\' . $payableType;
        $payableModel = $payableModel::find($payableId);
        $userableType = ucfirst(request()->input('userable_type'));
        $userableModel = 'App\\Models\\' . $userableType;
        $userableModel = $userableModel::find($userableId);

        $response = $this->gateway->purchase([
            'amount' => round($payableModel->total_amount, 2),
            'currency' => $currency,
            'returnUrl' => $returnUrl,
            'cancelUrl' => $cancelUrl,
            'paymentMethod' => 'paypal',
        ]);
        $response = $response->send();
        if ($response->isSuccessful() && $response->isRedirect()) {
        $data = $response->getData();
        PaymentTransaction::create([
            'transaction_id' => $data['id'],
            'payable_id' => $payableModel->id,
            'payable_type' => get_class($payableModel),
            'userable_id' => $userableModel->id,
            'userable_type' => get_class($userableModel),
            'amount' => $data['transactions'][0]['amount']['total'],
            'currency' => $data['transactions'][0]['amount']['currency'],
            'payment_method' => 'paypal',
            'payment_gateway_data' => json_encode($response->getData()),


        ]);

            return response()->apiResponse(data: ['redirect_url' => $response->getData()['links'][1]['href']]);

        } else {
            throw new \Exception("Payment failed: " . $response->getMessage());
        }


    }

    public function success($requestData)
    {
        $response = $this->gateway->completePurchase([
            'payer_id' => $requestData['PayerID'],
            'transactionReference' => $requestData['paymentId'],
        ])->send();
        if ($response->isSuccessful()) {
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
