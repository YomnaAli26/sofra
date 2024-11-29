<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\StoreOfferRequest;
use App\Http\Requests\Restaurant\UpdateOfferRequest;
use App\Http\Resources\OfferResource;
use App\Services\OfferService;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct(public OfferService $offerService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = $this->offerService->getRestaurantOffers();
        return response()->apiResponse(data: OfferResource::collection($offers));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {
        $offer = $this->offerService->storeResource($request->validated());
        return response()->apiResponse(201,data: OfferResource::make($offer));

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $offer = $this->offerService->showResource($id);
        return response()->apiResponse(data: OfferResource::make($offer));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, string $id)
    {
        $offer = $this->offerService->updateResource($id,$request->validated());
        return response()->apiResponse(data: OfferResource::make($offer));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->offerService->deleteResource($id);
        return response()->apiResponse(204);

    }
}
