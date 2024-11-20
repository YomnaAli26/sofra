<?php

namespace App\Services;

use App\Repositories\Interfaces\AreaRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;

class AreaService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public AreaRepositoryInterface $areaRepository)
    {

    }
    public function getAreasByCity(int $cityId)
    {
        $this->areaRepository->relations = 'city';
        return $this->areaRepository->getBy('city_id',$cityId);
    }
}
