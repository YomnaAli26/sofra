<?php

namespace App\Services;


use App\Repositories\Interfaces\CommissionRepositoryInterface;

class CommissionService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public CommissionRepositoryInterface $commissionRepository)
    {
        parent::__construct($commissionRepository);
    }

    public function getCommission()
    {
        return $this->commissionRepository->withRelations(['restaurant'])->findBy([
            'restaurant_id' => auth('restaurant')->user()->id,
        ]);
    }
}
