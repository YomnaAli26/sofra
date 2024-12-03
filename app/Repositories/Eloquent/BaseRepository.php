<?php

namespace App\Repositories\Eloquent;


use App\Repositories\Interfaces\BaseInterface;
use Illuminate\Database\Eloquent\{Builder, Collection};
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository implements BaseInterface
{
    protected array $relations = [];
    public function __construct(public $model)
    {
    }
    public function query():Builder
    {
        return $this->model->with($this->relations);
    }
    public function withRelations($relations): static
    {
        $this->relations = $relations;
        return $this;
    }

    public function all(): Collection
    {
        return $this->query()->latest()->get();
    }

    public function paginate($perPage = 10): LengthAwarePaginator
    {
        return $this->query()->latest()->paginate($perPage);
    }

    public function filter()
    {
        if (!method_exists($this->model,'scopeFilter')) {
            throw new \BadMethodCallException('Filter method not defined in ' . get_class($this->model));
        }
        return $this->query()->filter();
    }


    public function create(array $data)
    {
        return $this->model->create($data);

    }

    public function find($id)
    {
        return $this->query()->findOrFail($id);
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
        return$this->query()->where($conditions)->get();
    }

    public function findBy(array $conditions)
    {
        return $this->query()->where($conditions)->first();

    }
    public function whereIn(string $column, array $values): static
    {
         $this->query()->whereIn($column, $values);
         return $this;
    }
}
