<?php

namespace Database\Seeders;

use App\Enums\AdminRoleEnum;
use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\Meal;
use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::query()->create([
            'name' => 'Super Admin',
            'email' => 'super-admin@admin.com',
            'password' => 123456789,
        ]);
        $user->assignRole(AdminRoleEnum::SUPER_ADMIN->value);
//        City::factory(10)->create();
//        Area::factory(10)->create();
//        Category::factory(10)->create();
        $this->call([
            SettingSeeder::class,
            RolesAndPermissionsSeeder::class,
            ]);
    }
}
