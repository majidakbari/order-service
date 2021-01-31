<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Bundles\Order\Entities\Rule;
use App\Bundles\Order\Entities\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory()
            ->hasAttached(
                Rule::factory()->active()->count(10),
                ['amount' => rand(1, 5)]
            )->available()->count(5)->create();
    }
}
