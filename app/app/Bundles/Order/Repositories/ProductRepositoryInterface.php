<?php

namespace App\Bundles\Order\Repositories;

use App\Common\Repositories\EloquentRepositoryInterface;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface extends EloquentRepositoryInterface
{
    public function findManyByIds(array $ids): Collection;
}
