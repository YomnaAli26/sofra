<?php

namespace App\Services;

use App\Repositories\Interfaces\AreaRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use Illuminate\Support\Arr;

class BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public $repository)
    {

    }
    public function index($relations, $usePagination = false,$perPage = 10)
    {
        return $usePagination
            ? $this->repository->withRelations($relations)->paginate($perPage)
            : $this->repository->withRelations($relations)->all();
    }

    public function create()
    {

    }

    public function store(array $data)
    {
        if (count(request()->allFiles()) > 0)
        {

        }
        $modelData = $this->repository->create(Arr::except($data,'image'));
        $modelData->addMedia($data['image'])->toMediaCollection('meals');
        return $modelData ;

    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function edit()
    {

    }

    public function update()
    {

    }
}
