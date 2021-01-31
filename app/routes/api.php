<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/order')->namespace('Order\Controllers')->as('order.')->group(function () {
        Route::post('/price', 'GetOrderPriceController')->name('price.get');
});
