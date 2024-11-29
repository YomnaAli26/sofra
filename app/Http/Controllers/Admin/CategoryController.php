<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Http\Requests\{StoreCategoryRequest, UpdateCategoryRequest};
use App\Services\CityService;


class CategoryController extends DashboardController
{
    public function __construct(CityService $cityService)
    {
        parent::__construct($cityService);
        $this->storeRequestClass = new StoreCategoryRequest();
        $this->updateRequestClass = new UpdateCategoryRequest();
        $this->indexView = 'categories.index';
        $this->createView = 'categories.create';
        $this->editView = 'categories.edit';
        $this->showView = 'categories.show';
        $this->usePagination = true;
        $this->successMessage = 'Process success';
    }

}
