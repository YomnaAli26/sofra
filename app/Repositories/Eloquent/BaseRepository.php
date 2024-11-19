<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\CommissionRepositoryInterface;

class BaseRepository
{
    public function __construct(protected $model)
    {
    }

    public function all()
    {
        return $this->model->latest('id')->get();
    }

    public function paginate($perPage = 10)
    {
        return $this->model->latest()->paginate($perPage);
    }

    public function filter($data,$relations=[])
    {
        return $this->model->with($relations)->filter($data);
    }

    public function create(array $data)
    {
        return $this->model->create($data);

    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $modelObject = $this->find($id);
        if ($modelObject) {
            $modelObject->update($data);
            $modelObject->refresh();
        }
        return $modelObject;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();

    }

    public function with($relations)
    {
        return $this->model->with($relations)->get();
    }
}
