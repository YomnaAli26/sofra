<?php

namespace App\Services;

use App\Repositories\Interfaces\OfferRepositoryInterface;

class OfferService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public OfferRepositoryInterface $offerRepository)
    {
        parent::__construct($offerRepository);
    }

    public function getRestaurantOffers()
    {
        return $this->offerRepository->withRelations(['restaurant'])
            ->getBy(['restaurant_id' => auth('restaurant')->user()->id]);
    }
}
