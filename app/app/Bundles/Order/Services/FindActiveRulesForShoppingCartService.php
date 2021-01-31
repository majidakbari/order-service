<?php

namespace App\Bundles\Order\Services;

use Illuminate\Support\Collection;
use App\Bundles\Order\Repositories\RuleRepositoryInterface;

class FindActiveRulesForShoppingCartService
{
    public function __construct(private RuleRepositoryInterface $ruleRepository)
    {
    }

    public function __invoke(array $productIds): Collection
    {
        return $this->ruleRepository->findActiveRulesByProductIds($productIds);
    }
}
