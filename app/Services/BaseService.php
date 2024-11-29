<?php

namespace App\Services;

use App\Repositories\Interfaces\AreaRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class BaseService
{
    protected array $files;

    public function __construct(public $repository)
    {
        $this->files = request()->allFiles();
    }

    public function getData($relations = [], $usePagination = false, $perPage = 10)
    {
        return $usePagination
            ? $this->repository->withRelations($relations)->paginate($perPage)
            : $this->repository->withRelations($relations)->all();
    }


    public function storeResource(array $data)
    {
        $dataWithoutFiles = Arr::except($data, array_keys($this->files));
        $modelData = $this->repository->create($dataWithoutFiles);
        if (!empty($this->files)) {
            $this->handleMediaUploads($modelData);
            return $modelData;
        }
        return $modelData;

    }

    public function showResource($id)
    {
        return $this->repository->find($id);
    }


    public function updateResource($id, $data)
    {
        $dataWithoutFiles = Arr::except($data, array_keys($this->files));

        if (!empty($this->files)) {
            $modelData = $this->repository->find($id);
            $this->clearMedia($modelData);
            $this->handleMediaUploads($modelData);
            $modelData->update($dataWithoutFiles);
            return $modelData;
        }
        return $this->repository->update($data, $id);
    }

    public function deleteResource($id): void
    {
        $modelData = $this->repository->find($id);
        $this->clearMedia($modelData);
        $modelData->delete();

    }

    protected function getMediaCollectionName($modelData): string
    {
        return Str::plural(Str::lcfirst(class_basename($modelData)));
    }

    protected function clearMedia($modelData): void
    {
        $collectionName = $this->getMediaCollectionName($modelData);
        $modelData->clearMediaCollection($collectionName);
    }

    protected function handleMediaUploads($modelData, bool $clearExisting = false): void
    {
        $collectionName = $this->getMediaCollectionName($modelData);

        if ($clearExisting) {
            $modelData->clearMediaCollection($collectionName);
        }
        foreach ($this->files as $file) {
            $modelData->addMedia($file)->toMediaCollection($collectionName);
        }
    }
}
