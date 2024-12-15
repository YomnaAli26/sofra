<?php

namespace App\Services;

use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public RoleRepositoryInterface $roleRepository)
    {
        parent::__construct($roleRepository);
    }

    public function storeResource(array $data)
    {
        $role = $this->roleRepository->create($data);
        $data['permissions'] ??= [];
        $role->syncPermissions($data['permissions']);
        return $role;
    }
    public function updateResource($id, $data)
    {
        $role = $this->roleRepository->update($data,$id);
        $data['permissions'] ??= [];
        $role->syncPermissions($data['permissions']);
        return $role;
    }
    public function deleteResource($id): void
    {
        $role = $this->roleRepository->delete($id);
        $role->syncPermissions([]);
    }

}
