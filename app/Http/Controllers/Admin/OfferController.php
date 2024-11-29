<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Http\Requests\{StoreCategoryRequest, UpdateCategoryRequest};
use App\Services\CityService;


class OfferController extends DashboardController
{
    public function __construct(CityService $cityService)
    {
        parent::__construct($cityService);
        $this->storeRequestClass = new StoreCategoryRequest();
        $this->updateRequestClass = new UpdateCategoryRequest();
        $this->indexView = 'offers.index';
        $this->createView = 'offers.create';
        $this->editView = 'offers.edit';
        $this->showView = 'offers.show';
        $this->usePagination = true;
        $this->successMessage = 'Process success';
    }

}
