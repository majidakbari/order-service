<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Bundles\Order\Repositories\ProductRepository;
use App\Bundles\Order\Repositories\ProductRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    public function boot(): void
    {
    }
}
