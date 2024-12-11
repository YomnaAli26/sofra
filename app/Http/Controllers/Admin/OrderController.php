<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Services\OrderService;


class OrderController extends DashboardController
{
    public function __construct(OrderService $areaService)
    {
        parent::__construct($areaService);
        $this->indexView = 'orders.index';
        $this->showView = 'orders.show';
        $this->usePagination = true;
        $this->useFilter = true;
        $this->relations = ['client', 'restaurant'];
        $this->successMessage = 'Process success';
    }

}
