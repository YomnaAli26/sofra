<?php

namespace App\Providers;

use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Routing\Route;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->getModels() as $model)
        {
            $this->app->bind("App\\Repositories\\Interfaces\\{$model}RepositoryInterface",
                "App\\Repositories\\Eloquent\\{$model}Repository");
        }
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    private function getModels()
    {
        $modelFiles = File::allFiles(app_path("Models"));
        return collect($modelFiles)->map(function ($file) {
           return basename($file->getFilename(),'.php');
        });

    }
}
