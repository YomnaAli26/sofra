<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;

use App\Repositories\Interfaces\AreaRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\ClientService;
use App\Services\RestaurantService;
use App\Http\Requests\{Client\RegisterRequest, UpdateClientRequest};



class ClientController extends DashboardController
{
    public function __construct(
        ClientService $clientService,
        public AreaRepositoryInterface $areaRepository,

    )
    {
        parent::__construct($clientService);
        $this->storeRequestClass = new RegisterRequest();
        $this->updateRequestClass = new UpdateClientRequest();
        $this->indexView = 'clients.index';
        $this->createView = 'clients.create';
        $this->createData = [
            'areas' => $this->areaRepository->all(),
        ];
        $this->editView = 'clients.edit';
        $this->editData = [
            'areas' => $this->areaRepository->all(),
        ];
        $this->indexData = [
            'areas' => $this->areaRepository->all(),
        ];
        $this->showView = 'clients.show';
        $this->usePagination = true;
        $this->useFilter = true;
        $this->partialFolder = 'clients';
        $this->relations = ['area',];
        $this->successMessage = 'Process success';
    }

}
