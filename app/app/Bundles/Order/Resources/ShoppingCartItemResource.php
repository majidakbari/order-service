<?php

namespace App\Bundles\Order\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ShoppingCartItemResource
 * @package App\Bundles\Order\Resources
 * @property int amount
 * @property ProductResource product
 */
class ShoppingCartItemResource extends JsonResource
{
    public function toArray($request): array
    {
       return [
           'amount' => $this->amount,
           'product' => ProductResource::make($this->product)
       ];
    }
}
