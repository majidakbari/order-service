<?php

namespace Database\Factories;

use App\Bundles\Order\Entities\Rule;
use Illuminate\Database\Eloquent\Factories\Factory;

class RuleFactory extends Factory
{
    protected $model = Rule::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'is_active' => $this->faker->boolean
        ];
    }

    public function active(): self
    {
        return $this->state(function () {
            return [
                'is_active' => true,
            ];
        });
    }
}
