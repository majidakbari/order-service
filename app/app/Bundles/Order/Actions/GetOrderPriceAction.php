<?php

namespace App\Bundles\Order\Actions;

use App\Bundles\Order\DataTransferObjects\ShoppingCart;

class GetOrderPriceAction
{
    public function __construct()
    {

    }

    public function __invoke(ShoppingCart $shoppingCart)
    {
        dd($shoppingCart);
    }
}
