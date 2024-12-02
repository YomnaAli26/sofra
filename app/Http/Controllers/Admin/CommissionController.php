<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Services\CommissionService;
use App\Http\Requests\{StoreCityRequest, UpdateCityRequest};
use App\Services\CityService;


class CommissionController extends DashboardController
{
    public function __construct(CommissionService $commissionService)
    {
        parent::__construct($commissionService);
        $this->storeRequestClass = new StoreCityRequest();
        $this->updateRequestClass = new UpdateCityRequest();
        $this->indexView = 'commissions.index';
        $this->createView = 'commissions.create';
        $this->editView = 'commissions.edit';
        $this->showView = 'commissions.show';
        $this->usePagination = true;
        $this->relations = ['restaurant'];

        $this->successMessage = 'Process success';
    }

}
