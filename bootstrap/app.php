<?php

use App\Http\Middleware\{AutoCheckPermission, LangMiddleware};
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

            Route::middleware("web")
                ->prefix('admin/dashboard')
                ->as('admin.')
                ->namespace('App\Http\Controllers\Admin')
                ->group(base_path("routes/admin.php"));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(append: [
            LangMiddleware::class,
        ]);
        $middleware->web(append: [
            LangMiddleware::class,
        ]);
        $middleware->alias([
            'lang' => LangMiddleware::class,
            'auto-check-permission' => AutoCheckPermission::class,
        ]);
        $middleware->redirectGuestsTo(fn()=> route("admin.login"));
        $middleware->redirectUsersTo(fn()=> route("admin.dashboard"));
    })
    ->withExceptions(function (Exceptions $exceptions) {

    })->create();
