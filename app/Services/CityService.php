<?php

namespace App\Services;

use App\Repositories\Interfaces\CityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CityService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public CityRepositoryInterface $cityRepository)
    {

    }
    public function getAllCities(): Collection
    {
        return $this->cityRepository->getCitiesHavingAreas();
    }
}
