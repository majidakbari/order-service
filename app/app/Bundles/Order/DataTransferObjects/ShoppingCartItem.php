<?php

namespace App\Bundles\Order\DataTransferObjects;

class ShoppingCartItem
{
    public function __construct(public int $productId, public int $amount)
    {
    }

    public static function fromArray(array $attributes): self
    {
        return new static($attributes['product_id'], $attributes['amount']);
    }
}
