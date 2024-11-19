<?php

namespace App\Repositories\Interfaces;
interface BaseInterface
{
    public function all();
    public function paginate($perPage);
    public function filter($data,$relations);
    public function create(array $data);

    public function update(array $data, $id);


    public function delete($id);
    public function find($id);
    public function with($relations);

}
