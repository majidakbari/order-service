<?php

namespace App\Bundles\Order\Repositories;

use Illuminate\Support\Collection;
use App\Bundles\Order\Entities\Rule;
use Illuminate\Database\Eloquent\Builder;
use App\Common\Repositories\BaseRepository;

class RuleRepository extends BaseRepository implements RuleRepositoryInterface
{
    protected function model(): string
    {
        return Rule::class;
    }

    public function findActiveRulesByProductIds(array $productIds): Collection
    {
        return $this->query()->where('is_active', true)->whereHas('products',
            function (Builder $query) use ($productIds) {
                $query->where('product_id', $productIds);
            })->with('products')->get();
    }
}
