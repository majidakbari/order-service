<?php

namespace App\Bundles\Order\Repositories;

use Illuminate\Support\Collection;
use App\Bundles\Order\Entities\Product;
use App\Common\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected function model(): string
    {
        return Product::class;
    }

    public function findManyByIds(array $ids): Collection
    {
        return $this->query()->whereIn('id', $ids)->get();
    }
}
