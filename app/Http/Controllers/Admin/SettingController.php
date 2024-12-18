<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{SettingRequest};
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Support\Facades\Cache;


class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }
    public function update(SettingRequest $request,SettingRepositoryInterface $settingRepository)
    {
        $lang = app()->getLocale();
        $validatedData = $request->validated();
        foreach ($validatedData as $key => $value) {
            $settingRepository->findByKey($key)->update(['value' => $value]);
        }
        Cache::forget("settings_{$lang}");
        Cache::remember("settings_{$lang}", 60, function () use ($settingRepository){
            return $settingRepository->all();
        });
        return to_route('admin.settings.index')
            ->with('success','Process success');

    }

}
