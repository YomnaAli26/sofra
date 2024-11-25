<?php

namespace App\Repositories\Eloquent;




use App\Repositories\Interfaces\BaseInterface;
use Illuminate\Http\Request;

class BaseRepository implements BaseInterface
{
    protected array $relations = [];
    public function __construct(protected $model)
    {
    }
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->model->with($this->relations);
    }
    public function withRelations($relations): static
    {
        $this->relations = $relations;
        return $this;
    }

    public function all()
    {
        return $this->model->with($this->relations)->latest()->get();
    }

    public function paginate($perPage = 10)
    {
        return $this->model->with($this->relations)->latest()->paginate($perPage);
    }

    public function filter()
    {
        if (!method_exists($this->model,'filter')) {
            return $this->model->with($this->relations)->filter();
        }
        throw new \BadMethodCallException('Filter method not defined in ' . get_class($this->model));
    }


    public function create(array $data)
    {
        return $this->model->create($data);

    }

    public function find($id)
    {
        return $this->model->with($this->relations)->find($id);
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

    public function getBy(array $conditions)
    {
        return $this->model->with($this->relations)->where($conditions)->get();
    }

    public function findBy(array $conditions)
    {
        return $this->model->with($this->relations)->where($conditions)->first();

    }
    public function whereIn(string $column, array $values)
    {
        return $this->model->with($this->relations)->whereIn($column, $values)->get();
    }
}
