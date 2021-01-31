<?php

namespace App\Bundles\Order\Controllers;

use App\Bundles\Order\Actions\GetOrderPriceAction;
use App\Bundles\Order\Requests\GetOrderPriceRequest;
use App\Bundles\Order\Resources\ShoppingCartResource;
use App\Bundles\Order\DataTransferObjects\ShoppingCart;

class GetOrderPriceController
{
    public function __construct(public GetOrderPriceAction $getOrderPriceAction)
    {
    }

    public function __invoke(GetOrderPriceRequest $request): ShoppingCartResource
    {
        $result = ($this->getOrderPriceAction)(ShoppingCart::fromArray($request->all()));

        return new ShoppingCartResource($result);
    }
}
