<?php

namespace App\Http\Controllers\Api\Restaurant\Auth;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Illuminate\Http\Request;


class ResetPasswordController extends Controller
{
    public function __construct(public ClientService $clientService)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required','exists:clients,email'],
            'code' => ['required','exists:clients,code'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $this->clientService->resetPassword($validated);
        return response()->apiResponse(message: "your password has been reset");

    }
}
