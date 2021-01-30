<?php

namespace App\Bundles\Order\Controllers;

use Illuminate\Http\JsonResponse;
use App\Bundles\Order\Requests\GetOrderPriceRequest;

class GetOrderPriceController
{
    public function __invoke(GetOrderPriceRequest $request): JsonResponse
    {
        return response()->json([1 =>2]);
    }
}
