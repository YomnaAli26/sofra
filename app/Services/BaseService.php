<?php

namespace App\Services;

use App\Repositories\Interfaces\AreaRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

abstract class  BaseService
{
    protected array $files;

    public function __construct(public $repository)
    {
        $this->files = request()->allFiles();
    }

    public function getData($relations = [], $usePagination = false, $perPage = 10, $useFilter = false)
    {
        if ($usePagination) {
            if ($useFilter) {
                return $this->repository->withRelations($relations)->filter()->paginate($perPage);
            }
            return $this->repository->withRelations($relations)->paginate($perPage);

        }
        return $this->repository->withRelations($relations)->all();

    }


    public function storeResource(array $data)
    {
        $modelData = $this->repository->create($data);
        if (!empty($this->files)) {
            handleMediaUploads($this->files, $modelData);
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
        if (!empty($this->files)) {
            $modelData = $this->repository->find($id);
            handleMediaUploads($this->files, $modelData,true);
            $modelData->update($data);
            return $modelData;
        }
        return $this->repository->update($data, $id);
    }

    public function deleteResource($id): void
    {
        $modelData = $this->repository->find($id);
        if (method_exists($modelData, 'hasMedia') && $modelData->hasMedia()) {
            clearMedia($modelData);
        }
        $modelData->delete();

    }
}
