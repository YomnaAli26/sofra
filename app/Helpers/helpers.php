<?php

use App\Repositories\Interfaces\SettingRepositoryInterface;

if (!function_exists('settings')) {
    function settings()
    {
        $settingRepository = app(SettingRepositoryInterface::class);
        return $settingRepository->all();
    }

}
