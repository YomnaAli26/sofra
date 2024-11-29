<?php

namespace App\Services;

use App\Repositories\Interfaces\AreaRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;

class AreaService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public AreaRepositoryInterface $areaRepository)
    {
        parent::__construct($areaRepository);
    }

    public function getAreasByCity(int $cityId)
    {
        return $this->areaRepository->withRelations(['city'])->getBy(['city_id' => $cityId]);
    }
}
