<?php

namespace App\Services;

use App\Repositories\Eloquent\PaymentMethodRepository;


class PaymentMethodService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public PaymentMethodRepository $paymentMethodRepository)
    {
        parent::__construct($paymentMethodRepository);
    }

}
