<?php

namespace App\Bundles\Order\Repositories;

use Illuminate\Support\Collection;
use App\Common\Repositories\EloquentRepositoryInterface;

interface RuleRepositoryInterface extends EloquentRepositoryInterface
{
    public function findActiveRulesByProductIds(array $productIds): Collection;
}
