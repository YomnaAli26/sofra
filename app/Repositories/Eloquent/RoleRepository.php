<?php

namespace App\Repositories\Eloquent;


use App\Repositories\Interfaces\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }
}
