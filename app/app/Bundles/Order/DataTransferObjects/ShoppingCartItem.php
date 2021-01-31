<?php

namespace App\Bundles\Order\DataTransferObjects;

use App\Bundles\Order\Entities\Product;

/**
 * Class ShoppingCartItem
 * @package App\Bundles\Order\DataTransferObjects
 * @property int productId
 * @property int amount
 */
class ShoppingCartItem
{
    public function __construct(public int $productId, public int $amount, public ?Product $product = null)
    {
    }

    public static function fromArray(array $attributes): self
    {
        return new static($attributes['product_id'], $attributes['amount']);
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}
