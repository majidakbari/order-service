<?php

namespace App\Bundles\Order\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ShoppingCartItemCollection extends ResourceCollection
{
    public $collects = ShoppingCartItemResource::class;
}
