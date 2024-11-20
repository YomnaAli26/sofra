<?php

namespace App\Repositories\Eloquent;


use App\Models\Area;
use App\Repositories\Interfaces\AreaRepositoryInterface;


class AreaRepository extends BaseRepository implements AreaRepositoryInterface
{

    public function __construct(Area $area)
    {
        parent::__construct($area);
    }

}
