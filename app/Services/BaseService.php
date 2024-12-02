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

    /**
     * @throws \Exception
     */
    public function getData($relations = [], $usePagination = false, $perPage = 10)
    {
        $repoModel = $this->repository->model;

        if (!method_exists($repoModel, 'scopeFilter')) {

            if ($usePagination) {
                return $this->repository->withRelations($relations)->paginate($perPage);
            }
            return $this->repository->withRelations($relations)->all();
        }

        if ($usePagination) {
            return $this->repository
                ->withRelations($relations)
                ->filter()
                ->paginate($perPage);
        }

    }



    public function storeResource(array $data)
    {
        $dataWithoutFiles = Arr::except($data, array_keys($this->files));
        $modelData = $this->repository->create($dataWithoutFiles);
        if (!empty($this->files)) {
            handleMediaUploads($this->files,$modelData);
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
            clearMedia($modelData);
            handleMediaUploads($this->files,$modelData);
            $modelData->update($dataWithoutFiles);
            return $modelData;
        }
        return $this->repository->update($data, $id);
    }

    public function deleteResource($id): void
    {
        $modelData = $this->repository->find($id);
        if (method_exists($modelData, 'hasMedia') && $modelData->hasMedia())
        {
            clearMedia($modelData);
        }
        $modelData->delete();

    }
}
