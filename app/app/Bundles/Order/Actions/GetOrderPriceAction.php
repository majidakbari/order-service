<?php

namespace App\Bundles\Order\Actions;

use App\Bundles\Order\Services\FindOrderItemsService;
use App\Bundles\Order\DataTransferObjects\ShoppingCart;
use App\Bundles\Order\DataTransferObjects\ShoppingCartItem;
use App\Bundles\Order\Services\ApplyRulesToShoppingCartService;
use App\Bundles\Order\Services\FindActiveRulesForShoppingCartService;

class GetOrderPriceAction
{
    public function __construct
    (
        private FindOrderItemsService $findOrderItemsService,
        private ApplyRulesToShoppingCartService $applyRulesToShoppingCartService,
        private FindActiveRulesForShoppingCartService $findActiveRulesForShoppingCartService
    )
    {
    }

    public function __invoke(ShoppingCart $shoppingCart): ShoppingCart
    {
        $productIds = array_map(function(ShoppingCartItem $shoppingCartItem) {
            return $shoppingCartItem->productId;
        }, $shoppingCart->cart);

        $products = ($this->findOrderItemsService)($productIds);

        array_map(function (ShoppingCartItem $shoppingCartItem) use ($products) {
            $shoppingCartItem->setProduct($products->where('id', $shoppingCartItem->productId)->first());
        }, $shoppingCart->cart);

        $rules = ($this->findActiveRulesForShoppingCartService)($productIds);

        return $shoppingCart->setTotalPrice(
            ($this->applyRulesToShoppingCartService)($shoppingCart, $rules)
        );
    }
}
