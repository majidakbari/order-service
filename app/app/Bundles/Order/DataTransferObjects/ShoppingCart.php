<?php

namespace App\Bundles\Order\DataTransferObjects;

class ShoppingCart
{
    public function __construct(public array $cart)
    {
    }

    public static function fromArray(array $attributes): self
    {
        $items = [];
        foreach ($attributes['cart'] as $shoppingCartItem) {
            $items[] = ShoppingCartItem::fromArray($shoppingCartItem);
        }

        return new static($items);
    }
}
