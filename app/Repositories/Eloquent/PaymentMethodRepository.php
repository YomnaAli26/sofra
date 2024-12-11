<?php

namespace App\Repositories\Eloquent;

use App\Models\PaymentMethod;

use App\Repositories\Interfaces\UserRepositoryInterface;

class PaymentMethodRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(PaymentMethod $paymentMethod)
    {
        parent::__construct($paymentMethod);
    }
}
