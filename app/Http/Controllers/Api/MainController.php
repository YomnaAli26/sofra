<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Resources\CityResource;
use App\Models\Setting;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Services\CityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    public function __construct(
        public CityService                $cityService,
        public SettingRepositoryInterface $settingRepository,
        public ContactRepositoryInterface $contactRepositoryI
    )
    {
    }

    public function cities()
    {
        $cities = $this->cityService->getAllCities();
        return response()->apiResponse(200, data: CityResource::collection($cities));
    }

    public function settings()
    {
        $lang = app()->getLocale();
        $settings = Cache::remember("settings_{$lang}", 3600, function () use ($lang) {
            return $this->settingRepository->all();
        });
        return response()->apiResponse(200, data: $settings);

    }

    public function contactUs(StoreContactRequest $request)
    {
        $contact = $this->contactRepositoryI->create($request->validated());
        return response()->apiResponse(200, "Message Sent Successfully",data: $contact);
    }
}
