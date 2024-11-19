<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

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
