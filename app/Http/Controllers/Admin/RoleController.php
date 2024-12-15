<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\DashboardController;
use App\Http\Requests\{StoreRoleRequest, UpdateRoleRequest};
use App\Services\RoleService;
use Spatie\Permission\Models\Permission;


class RoleController extends DashboardController
{
    public function __construct(
        RoleService $clientService,
    )
    {
        parent::__construct($clientService);
        $this->storeRequestClass = new StoreRoleRequest();
        $this->updateRequestClass = new UpdateRoleRequest();
        $this->indexView = 'roles.index';
        $this->createView = 'roles.create';
        $this->editView = 'roles.edit';
        $this->showView = 'roles.show';
        $this->sharedData = [
            'permissions' => Permission::all()
        ];
        $this->usePagination = true;
        $this->relations = [];
        $this->successMessage = 'Process success';
    }


}
