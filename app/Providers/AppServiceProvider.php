<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('apiResponse', function (int $status = 200,?string $message =null,$data=[]) {
            $message ??= "success";
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ],$status);
        });
    }
}
