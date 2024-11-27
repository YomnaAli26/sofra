<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreContactRequest;
use App\Http\Resources\AreaResource;
use App\Http\Resources\CityResource;
use App\Rules\CityHasAreas;
use App\Services\{AreaService, CityService, ContactService, SettingService};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\PersonalAccessToken;

class MainController extends Controller
{
    public function __construct(
        public CityService    $cityService,
        public SettingService $settingService,
        public ContactService $contactService,
        public AreaService $areaService,
    )
    {
    }

    public function cities()
    {
        $cities = $this->cityService->getAllCities();
        return response()->apiResponse(200, data: CityResource::collection($cities));
    }
    public function areas(Request $request)
    {
        $validated = $request->validate(['city_id' => ['required','integer','exists:cities,id',new CityHasAreas()]]);
        $areas = $this->areaService->getAreasByCity($validated["city_id"]);
        return response()->apiResponse(200, data: AreaResource::collection($areas));
    }

    public function settings()
    {
        $lang = app()->getLocale();
        $settings = Cache::remember("settings_{$lang}", 3600, function () use ($lang) {
            return $this->settingService->getAllSettings();
        });
        return response()->apiResponse(200, data: $settings);

    }

    public function contactUs(StoreContactRequest $request)
    {
        $contact = $this->contactService->create($request->validated());
        return response()->apiResponse(200, "Message Sent Successfully",data: $contact);
    }

    public function registerFcmToken(Request $request)
    {
        $validatedData = $request->validate(['fcm_token' => ['required']]);
        PersonalAccessToken::where('fcm_token', $validatedData['fcm_token'])->delete();
        $request->user()->tokens()->update($validatedData);
        return response()->apiResponse(200, "Token registered successfully");

    }

    public function deleteFcmToken(Request $request)
    {
        $validatedData = $request->validate(['fcm_token' => ['required']]);
        PersonalAccessToken::where('fcm_token', $validatedData['fcm_token'])->delete();
        return response()->apiResponse(200, "Token deleted successfully");

    }
}
