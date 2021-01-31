<?php

namespace App\Bundles\Order\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ShoppingCartResource
 * @package App\Bundles\Order\Resources
 * @property ShoppingCartItemCollection cart
 * @property int totalPrice
 */
class ShoppingCartResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'cart' => ShoppingCartItemCollection::make($this->cart),
            'total_price' => $this->totalPrice
        ];
    }
}
