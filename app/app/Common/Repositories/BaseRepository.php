<?php

namespace App\Common\Repositories;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository implements EloquentRepositoryInterface
{
    protected array $fillable = [];

    abstract protected function model(): string;

    public function __construct(private Container $container)
    {
    }

    public function fill(array $data, Model $object, array $fillable = []): Model
    {
        if (empty($fillable)) {
            $fillable = $this->fillable;
        }

        return $object->fillable($fillable)->fill($data);
    }

    public function create(array $data, array $fillable = []): Model
    {
        $object = $this->fill($data, $this->makeModel(), $fillable);
        $object->save();

        return $object;
    }

    public function update(array $data, Model $object, array $fillable = []): Model
    {
        $object = $this->fill($data, $object, $fillable);
        $object->save();

        return $object;
    }


    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function save(Model $model): bool
    {
        return $model->save();
    }

    public function find(int $id, $columns = ['*']): ?Model
    {
        return $this->query()->find($id, $columns);
    }

    public function query(): Builder
    {
        return $this->makeModel()->newQuery();
    }

    public function makeModel(): Model
    {
        $model = $this->container->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception(
                "Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model",
            );
        }

        return $model;
    }
}
