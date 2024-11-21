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
        $this->restaurantRepository->relations = ['reviews.restaurant','reviews.client'];
        $restaurant =$this->restaurantRepository->find($id);
        return $restaurant->reviews;
    }
    public function createReview($data)
    {
        $review = $this->reviewRepository->create($data);
        return $review;
    }


}
