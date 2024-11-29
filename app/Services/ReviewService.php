<?php

namespace App\Services;

use App\Repositories\Interfaces\RestaurantRepositoryInterface;
use App\Repositories\Interfaces\ReviewRepositoryInterface;


class ReviewService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public ReviewRepositoryInterface     $reviewRepository,
                                public RestaurantRepositoryInterface $restaurantRepository)
    {
        parent::__construct($reviewRepository);
    }

    public function getRestaurantReviews($id)
    {
        $restaurant = $this->restaurantRepository->withRelations(['reviews.restaurant', 'reviews.client'])
            ->find($id);
        return $restaurant->reviews;
    }

}
