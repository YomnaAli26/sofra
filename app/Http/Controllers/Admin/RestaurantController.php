<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;

use App\Repositories\Interfaces\AreaRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\RestaurantService;
use App\Http\Requests\{Restaurant\RegisterRequest, UpdateRestaurantRequest};



class RestaurantController extends DashboardController
{
    public function __construct(
        RestaurantService $restaurantService,
        public AreaRepositoryInterface $areaRepository,
        public CategoryRepositoryInterface $categoryRepository,

    )
    {
        parent::__construct($restaurantService);
        $this->storeRequestClass = new RegisterRequest();
        $this->updateRequestClass = new UpdateRestaurantRequest();
        $this->indexView = 'restaurants.index';
        $this->createView = 'restaurants.create';
        $this->createData = [
            'areas' => $this->areaRepository->all(),
            'categories' => $this->categoryRepository->all(),
        ];
        $this->editView = 'restaurants.edit';
        $this->editData = [
            'areas' => $this->areaRepository->all(),
            'categories' => $this->categoryRepository->all(),
        ];
        $this->showView = 'restaurants.show';
        $this->usePagination = true;
        $this->useFilter = true;
        $this->partialFolder = 'restaurants';
        $this->relations = ['area', 'category',];
        $this->successMessage = 'Process success';
    }

}
