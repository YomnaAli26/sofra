<?php

namespace Database\Seeders;

use App\Enums\AdminPermissionEnum;
use App\Enums\AdminRoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (AdminPermissionEnum::cases() as $permission)
        {
            Permission::query()->firstOrCreate([
                'name' => $permission->value,
                'guard_name' => 'web',
                'routes' => json_encode($permission->routes())
            ]);

        }
        foreach (AdminRoleEnum::cases() as $roleEnum)
        {
            $role = Role::query()->firstOrCreate(['name' => $roleEnum->value, 'guard_name' => 'web']);
            $role->syncPermissions($roleEnum->permissions());
        }
    }
}
