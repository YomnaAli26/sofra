<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ProfileRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;


class ProfileController extends Controller
{
    public function __construct(public ClientService $clientService)
    {
    }


    public function update(ProfileRequest $request)
    {
        $updatedData = $this->clientService->updateProfileData($request->validated(),auth('client')->user()->id);
        return response()->apiResponse(data:ClientResource::make($updatedData));

    }
    public function show()
    {
        $profileData = $this->clientService->showProfileData(auth('client')->user()->id);
        return response()->apiResponse(data:ClientResource::make($profileData));

    }
}
