<?php

namespace App\Traits;

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
