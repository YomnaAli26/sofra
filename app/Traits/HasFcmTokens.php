<?php
namespace App\Traits;
use App\Services\FilterService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


trait HasFcmTokens
{

    public function getDeviceTokens(): array
    {
        return $this->tokens()->pluck('fcm_token')->toArray();
    }
    public function routeNotificationForFcm(): array
    {
        return $this->getDeviceTokens();
    }

}
