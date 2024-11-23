<?php

namespace App\Services;




use App\Repositories\Interfaces\RestaurantRepositoryInterface;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use Illuminate\Support\Arr;


class ReviewService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public ReviewRepositoryInterface $reviewRepository,
    public RestaurantRepositoryInterface $restaurantRepository)
    {
    }
    public function getRestaurantReviews($id)
    {
        $restaurant =$this->restaurantRepository->withRelations(['reviews.restaurant','reviews.client'])
            ->find($id);
        return $restaurant->reviews;
    }
    public function createReview($data)
    {
        $review = $this->reviewRepository->create($data);
        return $review;
    }


}
