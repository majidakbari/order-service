<?php

namespace App\Bundles\Order\Repositories;

use App\Bundles\Order\Entities\Product;
use App\Common\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected function model(): string
    {
        return Product::class;
    }
}
