<?php

namespace App\Services;


use App\Repositories\Interfaces\SettingRepositoryInterface;

class SettingService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public SettingRepositoryInterface $settingRepository)
    {

    }
    public function getAllSettings()
    {
        return $this->settingRepository->all();
    }
}
