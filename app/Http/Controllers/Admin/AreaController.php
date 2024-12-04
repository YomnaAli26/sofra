<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Http\Requests\{StoreAreaRequest, UpdateAreaRequest};
use App\Services\AreaService;



class AreaController extends DashboardController
{
    public function __construct(AreaService $areaService)
    {
        parent::__construct($areaService);
        $this->storeRequestClass = new StoreAreaRequest();
        $this->updateRequestClass = new UpdateAreaRequest();
        $this->indexView = 'areas.index';
        $this->createView = 'areas.create';
        $this->createData = [
          'cities' => app(CityRepositoryInterface::class)->all(),
        ];
        $this->editData = [
          'cities' => app(CityRepositoryInterface::class)->all(),
        ];
        $this->editView = 'areas.edit';
        $this->showView = 'areas.show';
        $this->usePagination = true;
        $this->relations = ['city'];
        $this->successMessage = 'Process success';
    }

}