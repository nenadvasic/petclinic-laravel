<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all($columns = ['*']);

    public function with(array $relations);

    public function paginate($perPage = 15, $columns = ['*']);

    public function create(array $attributes);

    public function createModel(array $attributes);

    public function update(array $attributes, $id);

    public function updateModel(array $attributes, $id);

    public function delete($id);

    public function find($id, $columns = ['*']);

    public function findOrFail($id, $columns = ['*']);

    public function findBy($attribute, $value, $columns = ['*']);

    public function findAllBy($attribute, $value, $columns = ['*']);
}

