<?php

namespace App\Bundles\Order\DataTransferObjects;

/**
 * Class ShoppingCart
 * @package App\Bundles\Order\DataTransferObjects
 * @property array cart
 * @property float totalPrice
 */
class ShoppingCart
{
    public function __construct(public array $cart, public ?float $totalPrice = null)
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

    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }
}
