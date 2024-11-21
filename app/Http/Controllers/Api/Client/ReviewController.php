<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Services\ReviewService;


class ReviewController extends Controller
{
    public function __construct(public ReviewService  $reviewService)
    {
    }

    public function index()
    {
        $validatedData = request()->validate(['restaurant_id' => 'required','exists:restaurant,id']);
        $reviews = $this->reviewService->getRestaurantReviews($validatedData['restaurant_id']);
        return response()->apiResponse(data:ReviewResource::collection($reviews));
    }
    public function store(StoreReviewRequest $request)
    {
        $review = $this->reviewService->createReview($request->validated());
        return response()->apiResponse(data:ReviewResource::make($review));
    }
}
