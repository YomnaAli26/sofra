<?php

namespace App\Repositories\Interfaces;
use Illuminate\Http\Request;

interface BaseInterface
{

    public function all();
    public function paginate($perPage);
    public function filter();
    public function create(array $data);

    public function update(array $data, $id);


    public function delete($id);
    public function find($id);
    public function findBy(array $conditions);
    public function getBy(array $conditions);
    public function whereIn(string $column, array $values);


}
