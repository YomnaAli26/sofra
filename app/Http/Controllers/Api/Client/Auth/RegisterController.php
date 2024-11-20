<?php

namespace App\Http\Controllers\Api\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\RegisterRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;

class RegisterController extends Controller
{
    public function __construct(public ClientService $clientService)
    {
    }

    public function __invoke(RegisterRequest $request)
    {
        $registeredClient = $this->clientService->register($request->validated());
        $registeredClient->token = $registeredClient->createToken($registeredClient->email)->plainTextToken;
        return response()->apiResponse(201, data: ClientResource::make($registeredClient));
    }
}
