<?php

namespace App\Common\Repositories;

use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    public function save(Model $model): bool;
    public function create(array $data): Model;
    public function update(array $data, Model $object, array $fillable = []): Model;
    public function delete(Model $model): bool;
    public function find(int $id, $columns = ['*']): ?Model;
}
