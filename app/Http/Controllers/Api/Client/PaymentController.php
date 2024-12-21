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
        return $this->getPaymentContext()->executePayment($request->payable_id,
            $request->userableId,
            $request->currency,
            route("payment.success"),
            route("payment.failure"));
    }

    public function success()
    {
        dd($this->getPaymentContext()->processSuccessPayment(request()->all()));
    }

    public function failure()
    {

    }


}
