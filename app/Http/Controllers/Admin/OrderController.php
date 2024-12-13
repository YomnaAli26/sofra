<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Base\DashboardController;
use App\Services\OrderService;


class OrderController extends DashboardController
{
    public function __construct(OrderService $areaService)
    {
        parent::__construct($areaService);
        $this->indexView = 'orders.index';
        $this->partialFolder = 'orders';
        $this->showView = 'orders.show';
        $this->indexData = [
            'statuses' => OrderStatusEnum::cases()
        ];
        $this->usePagination = true;
        $this->useFilter = true;
        $this->relations = ['client', 'restaurant'];
        $this->successMessage = 'Process success';
    }
    public function printOrder()
    {

    }
}
