<?php

namespace App\Repositories\Eloquent;

use App\Models\City;
use App\Repositories\Interfaces\CityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    public function __construct(City $city)
    {
        parent::__construct($city);
    }

    public function getCitiesHavingAreas(): Collection
    {
        return City::query()->has('areas')->get();
    }
}
