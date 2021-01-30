<?php

namespace App\Bundles\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rule extends Model
{
    use HasFactory;

    public function rules(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('amount');
    }
}
