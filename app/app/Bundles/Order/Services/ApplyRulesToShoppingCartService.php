<?php

namespace App\Bundles\Order\Services;

use Illuminate\Support\Collection;
use App\Bundles\Order\Entities\Rule;
use App\Bundles\Order\Entities\Product;
use App\Bundles\Order\DataTransferObjects\ShoppingCart;
use App\Bundles\Order\DataTransferObjects\ShoppingCartItem;

class ApplyRulesToShoppingCartService
{
    public function __invoke(ShoppingCart $shoppingCart, Collection $rules, Collection $products): float
    {
        $totalPrice = 0;
        $productsArray = $this->getProductsArray($shoppingCart);
        $rulesArray = $this->getRulesArray($rules);

        foreach ($rulesArray as $ruleId => $rule) {
            $count = array_intersect_count($rule, $productsArray);
            if ($count != 0) {
                for ($i = 1; $i<= $count; $i++) {
                    $productsArray = subtract_array($productsArray, $rule);
                    $totalPrice += $rules->where('id', $ruleId)->first()->price;
                }
            }
        }
        if (!empty($productsArray)) {
            foreach ($productsArray as $leftProductId) {
                $totalPrice += $products->where('id', $leftProductId)->first()->price;
            }
        }

        return $totalPrice;
    }

    private function getProductsArray(ShoppingCart $shoppingCart): array
    {
        $allProducts = [];
        /** @var ShoppingCartItem $shoppingCartItem */
        foreach ($shoppingCart->cart as $shoppingCartItem) {
            for ($i = 1; $i <= $shoppingCartItem->amount; $i++) {
                $allProducts[] = $shoppingCartItem->productId;
            }
        }

        return $allProducts;
    }

    private function getRulesArray(Collection $rules): array
    {
        $allRules = [];
        /** @var Rule $rule */
        foreach ($rules as $rule) {
            /** @var Product $product */
            foreach ($rule->products as $product) {
                for ($i = 1; $i <= $product->pivot->amount; $i++) {
                    $allRules[$rule->id][] = $product->pivot->product_id;
                }
            }
        }

        return $allRules;
    }
}
