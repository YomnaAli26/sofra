<?php

namespace App\Http\Controllers\Api\Restaurant\Auth;

use App\Http\Controllers\Controller;

use App\Services\ClientService;
use Illuminate\Http\Request;



class ForgotPasswordController extends Controller
{
    public function __construct(public ClientService $clientService)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate(['email' => ['required','exists:clients,email'],]);
        $this->clientService->forgotPassword($request->email);
        return response()->apiResponse(message: "we send otp code on your email check it");

    }
}
