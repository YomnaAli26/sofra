<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Services\PaymentMethodService;
use App\Http\Requests\{StoreCategoryRequest,
    StorePaymentMethodRequest,
    UpdateCategoryRequest,
    UpdatePaymentMethodRequest};
use App\Services\CityService;


class PaymentMethodController extends DashboardController
{
    public function __construct(PaymentMethodService $paymentMethodService)
    {
        parent::__construct($paymentMethodService);
        $this->storeRequestClass = new StorePaymentMethodRequest();
        $this->updateRequestClass = new updatePaymentMethodRequest();
        $this->indexView = 'payment-methods.index';
        $this->createView = 'payment-methods.create';
        $this->editView = 'payment-methods.edit';
        $this->showView = 'payment-methods.show';
        $this->usePagination = true;
        $this->successMessage = 'Process success';
    }

}
