<?php

namespace App\Bundles\Order\Entities;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    public function rules(): BelongsToMany
    {
        return $this->belongsToMany(Rule::class)->withPivot('amount');
    }

    public static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
}
