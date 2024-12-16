<?php

namespace App\Providers;

use App\Services\PaymentStrategies\PaymentContext;
use App\Services\PaymentStrategies\PaypalPaymentStrategy;
use App\Services\PaymentStrategies\StripePaymentStrategy;
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
        $this->app->bind(PaymentContext::class, function ($app, $params) {
            $paymentMethod = $params[0] ?? null;
            match ($paymentMethod) {
                'paypal' => new PaymentContext(new PaypalPaymentStrategy()),
                'stripe' => new PaymentContext(new StripePaymentStrategy()),
                default => throw new \InvalidArgumentException('Invalid payment method'),
            };

        });
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
