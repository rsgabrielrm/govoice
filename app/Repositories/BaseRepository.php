<?php

namespace App\Repositories;

use App\Repositories\BaseRepositoryContract;

abstract class BaseRepository implements BaseRepositoryContract
{
    public function getById(int $id)
    {
        return $this->model->find($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getByAttribute(string $field, string $attribute)
    {
        return $this->model->where($field, $attribute);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function updateById(array $data, int $id)
    {
        return $this->model->where('id', $id)
            ->get()
            ->each
            ->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->where('id', $id)
            ->get()
            ->each
            ->delete();
    }

    public function getWithRelation(string $relation)
    {
        return $this->model->with($relation)->get();
    }

    public function getByIdAndWithRelations(int $id, array $relations)
    {
        return $this->model->where('id', $id)->with($relations);
    }

    public function getByAttributeAndWithRelations(string $field, string $attribute, array $relations)
    {
        return $this->model->where($field, $attribute)->with($relations);
    }
}