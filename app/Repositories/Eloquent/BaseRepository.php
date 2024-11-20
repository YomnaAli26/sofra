<?php

namespace App\Repositories\Eloquent;

use App\Models\Area;
use App\Repositories\Interfaces\CommissionRepositoryInterface;

class BaseRepository
{
    public $relations = [];
    public function __construct(protected $model)
    {
    }

    public function all()
    {
        return $this->model->with($this->relations)->latest()->get();
    }

    public function paginate($perPage = 10)
    {
        return $this->model->latest()->paginate($perPage);
    }

    public function filter($data)
    {
        return $this->model->with($this->relations)->filter($data);
    }

    public function create(array $data)
    {
        return $this->model->create($data);

    }

    public function find($id)
    {
        return $this->model->with($this->relations)->findOrFail($id);
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

    public function getBy($key,$value)
    {
        return $this->model->with($this->relations)->where($key,$value)->get();
    }

    public function findBy($key,$value)
    {
        return $this->model->with($this->relations)->where($key,$value)->first();

    }
}
