<?php

namespace App\Services;

use App\Repositories\Interfaces\CityRepositoryInterface;

class CityService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public CityRepositoryInterface $cityRepository)
    {

    }
    public function getAllCities()
    {
        return $this->cityRepository->all();
    }
}
