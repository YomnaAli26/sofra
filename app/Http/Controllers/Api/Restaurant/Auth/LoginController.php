<?php

namespace App\Http\Controllers\Api\Restaurant\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;

class LoginController extends Controller
{
    public function __construct(public ClientService $clientService)
    {
    }
    public function __invoke(LoginRequest $request)
    {
        $authenticatedClient = $this->clientService->login($request->validated());
        $authenticatedClient->token = $authenticatedClient->createToken($authenticatedClient["email"])->plainTextToken;
        return response()->apiResponse(200, data: ClientResource::make($authenticatedClient));

    }
}
