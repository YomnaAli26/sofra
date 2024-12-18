<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Http\Requests\{Client\RegisterRequest, Client\UpdateClientRequest};
use App\Repositories\Interfaces\AreaRepositoryInterface;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Services\ClientService;
use Illuminate\Http\Request;


class ClientController extends DashboardController
{
    public function __construct(
        ClientService $clientService,
        public AreaRepositoryInterface $areaRepository,
        public ClientRepositoryInterface $clientRepository,

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

    public function toggle(Request $request, $clientId): \Illuminate\Http\JsonResponse
    {
        $request->validate(['is_active' => 'required|boolean',]);
        $client = $this->clientRepository->find($clientId);
        $client->update($request->only(['is_active']));
        return response()->json([
            'success' => true,
        ]);

    }

}
