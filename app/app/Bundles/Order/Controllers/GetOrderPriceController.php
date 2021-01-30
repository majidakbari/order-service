<?php

namespace App\Bundles\Order\Controllers;

use Illuminate\Http\JsonResponse;

class GetOrderPriceController
{
    public function __invoke() :JsonResponse
    {
        return response()->json([1 =>2]);
    }
}
