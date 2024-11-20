<?php

use App\Http\Middleware\LangMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/general.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        apiPrefix: "api/general/v1",
        then: function () {
            Route::middleware("api")
                ->prefix('api/restaurant/v1')
                ->group(base_path("routes/restaurant.php"));

            Route::middleware("api")
                ->prefix('api/client/v1')
                ->group(base_path("routes/client.php"));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(append: [
            LangMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
