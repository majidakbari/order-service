<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Bundles\Order\Repositories\RuleRepository;
use App\Bundles\Order\Repositories\ProductRepository;
use App\Bundles\Order\Repositories\RuleRepositoryInterface;
use App\Bundles\Order\Repositories\ProductRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RuleRepositoryInterface::class, RuleRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    public function boot(): void
    {
    }
}
