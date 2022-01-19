<?php

namespace app\Repositories;

use App\Contracts\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository implements Repository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model= $model;
    }

    public function __call(string $method, array $parameters)
    {
        return $this->model->{$method}(...$parameters);
    }

    public function all()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($data = [])
    {
        return $this->model->create($data);
    }

    public function update($id, $data = [])
    {
        return $this->model->whereId($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->whereId($id)->delete();
    }

    public function paginate($perPage = 10, $column = ['*'])
    {
        return $this->model->orderBy('id', 'DESC')->paginate($perPage, $column);
    }
}
