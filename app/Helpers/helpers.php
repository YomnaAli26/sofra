<?php

use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Support\Str;

if (!function_exists('settings')) {
    function settings()
    {
        $settingRepository = app(SettingRepositoryInterface::class);
        return $settingRepository->all();
    }


}

if (!function_exists('getMediaCollectionName')) {
    function getMediaCollectionName($modelData): string
    {
        return Str::plural(Str::lcfirst(class_basename($modelData)));

    }
}

if (!function_exists('handleMediaUploads')) {
    function handleMediaUploads($files, $modelData, bool $clearExisting = false): void
    {
        $collectionName = getMediaCollectionName($modelData);

        if ($clearExisting) {
            $modelData->clearMediaCollection($collectionName);
        }
        foreach ($files as $file) {
            $modelData->addMedia($file)->toMediaCollection($collectionName);
        }
    }
}

if (!function_exists('clearMedia')) {
    function clearMedia($modelData): void
    {
        $collectionName = getMediaCollectionName($modelData);
        $modelData->clearMediaCollection($collectionName);
    }
}
