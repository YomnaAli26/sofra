<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Models\Restaurant;
use App\Repositories\Interfaces\RestaurantRepositoryInterface;
use App\Services\CommissionService;
use App\Http\Requests\{StoreCommissionRequest, UpdateCommissionRequest};



class CommissionController extends DashboardController
{
    public function __construct(CommissionService $commissionService, public RestaurantRepositoryInterface $restaurantRepository)
    {
        parent::__construct($commissionService);
        $this->storeRequestClass = new StoreCommissionRequest();
        $this->updateRequestClass = new UpdateCommissionRequest();
        $this->indexView = 'commissions.index';
        $this->createView = 'commissions.create';
        $this->createData =  [
            'restaurants' => $this->restaurantRepository->all(),
        ];
        $this->editData =  [
            'restaurants' => $this->restaurantRepository->all(),
        ];
        $this->editView = 'commissions.edit';
        $this->showView = 'commissions.show';
        $this->usePagination = true;
        $this->useFilter = true;
        $this->partialFolder = 'commissions';
        $this->relations = ['restaurant'];

        $this->successMessage = 'Process success';
    }

}
