<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Services\OfferService;
use App\Http\Requests\{StoreCategoryRequest, UpdateCategoryRequest};
use App\Services\CityService;


class OfferController extends DashboardController
{
    public function __construct(OfferService $offerService)
    {
        parent::__construct($offerService);
        $this->indexView = 'offers.index';
        $this->relations = ['restaurant'];
        $this->usePagination = true;
        $this->useFilter = true;
        $this->successMessage = 'Process success';
    }

}
