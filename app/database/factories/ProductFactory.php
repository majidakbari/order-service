<?php

namespace Database\Factories;

use App\Bundles\Order\Entities\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'is_available' => $this->faker->boolean
        ];
    }

    public function available(): self
    {
        return $this->state(function () {
            return [
                'is_available' => true,
            ];
        });
    }
}
