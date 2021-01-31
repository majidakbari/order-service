<?php

namespace App\Bundles\Order\Services;

use Illuminate\Support\Collection;
use App\Bundles\Order\Repositories\ProductRepositoryInterface;

class FindOrderItemsService
{
    public function __construct(private ProductRepositoryInterface $productRepository)
    {
    }

    public function __invoke(array $ids): Collection
    {
        return $this->productRepository->findManyByIds($ids);
    }
}
