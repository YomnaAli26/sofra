<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Http\Requests\City\{StoreCityRequest, UpdateCityRequest};
use App\Services\CityService;


class CityController extends DashboardController
{
    public function __construct(CityService $cityService)
    {
        parent::__construct($cityService);
        $this->storeRequestClass = new StoreCityRequest();
        $this->updateRequestClass = new UpdateCityRequest();
        $this->indexView = 'cities.index';
        $this->createView = 'cities.create';
        $this->editView = 'cities.edit';
        $this->showView = 'cities.show';
        $this->usePagination = true;
        $this->successMessage = 'Process success';
    }

}
