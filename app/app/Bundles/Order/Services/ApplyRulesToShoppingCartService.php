<?php

namespace App\Bundles\Order\Services;

use Illuminate\Support\Collection;
use App\Bundles\Order\DataTransferObjects\ShoppingCart;

class ApplyRulesToShoppingCartService
{
    public function __invoke(ShoppingCart $shoppingCart, Collection $rules): float
    {
        return 100.1;
    }
}
