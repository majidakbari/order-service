<?php

namespace App\Bundles\Order\Entities;

use Database\Factories\RuleFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rule extends Model
{
    use HasFactory;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('amount');
    }

    public static function newFactory(): RuleFactory
    {
        return RuleFactory::new();
    }
}
