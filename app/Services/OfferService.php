<?php

namespace App\Services;



use App\Repositories\Interfaces\OfferRepositoryInterface;
use Illuminate\Support\Arr;


class OfferService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public OfferRepositoryInterface $offerRepository)
    {
    }

    public function getRestaurantOffers()
    {
        return $this->offerRepository->withRelations(['restaurant'])
            ->getBy(['restaurant_id'=>auth('restaurant')->user()->id]);
    }
    public function getOffersForRestaurants()
    {
        return $this->offerRepository->withRelations(['restaurant'])
            ->paginate();
    }

    public function createOffer($data)
    {
        $offer = $this->offerRepository->create(Arr::except($data,'image'));
        $offer->addMedia($data['image'])->toMediaCollection('offers');
        return $offer;
    }

    public function showOffer($id)
    {
        return $this->offerRepository->find($id) ;
    }

    public function updateOffer($id,$data)
    {
        $offer = $this->offerRepository->update(Arr::except($data,'image'),$id);
        if (isset($data['image'])) {
            $offer->clearMediaCollection('offers');
            $offer->addMedia($data['image'])->toMediaCollection('offers');
        }
        return $offer ;
    }
    public function deleteOffer($id): void
    {
        $offer = $this->offerRepository->find($id);
        if ($offer) {
            $offer->clearMediaCollection('offers');

            $offer->delete();
        }
    }


}
