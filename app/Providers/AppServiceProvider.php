<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

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
        Model::preventLazyLoading();

        Response::macro('apiResponse', function (int $status = 200, ?string $message = null, $data = []) {
            $message ??= "success";
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $status);
        });

        if (request()->is('api/restaurant/*')) {
            Auth::shouldUse('restaurant');
        } else {
            Auth::shouldUse('client');

        }


    }
}
