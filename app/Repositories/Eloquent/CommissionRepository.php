<?php

namespace App\Repositories\Eloquent;


use App\Models\Commission;
use App\Repositories\Interfaces\CommissionRepositoryInterface;


class CommissionRepository extends BaseRepository implements CommissionRepositoryInterface
{
    public function __construct(Commission $commission)
    {
        parent::__construct($commission);
    }
}
