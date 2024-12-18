<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentRequest;
use App\Models\PaymentMethod;
use App\Services\PaymentStrategies\PaymentContext;


class PaymentController extends Controller
{
    protected $gateway;
    public function getPaymentContext()
    {

        if (!$this->gateway) {

            $this->gateway = app()->make(PaymentContext::class, [cache('paymentMethod')]);

        }
        return $this->gateway;
    }
    public function pay(PaymentRequest $request, PaymentMethod $paymentMethod)
    {
        cache()->put('paymentMethod', $paymentMethod->name);

        return $this->getPaymentContext()->executePayment($request->amount, $request->currency, route("payment.success"), route("payment.failure"));
    }

    public function success()
    {
        $paymentId = request('paymentId');
        $payerId = request('PayerID');
        if (!$paymentId || !$payerId) {
            return redirect()->route('payments.failure')->with('error', 'Missing payment details.');
        }

        dd($this->getPaymentContext());
    }

    public function failure()
    {

    }


}
