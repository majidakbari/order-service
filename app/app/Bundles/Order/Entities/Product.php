<?php

namespace App\Bundles\Order\Entities;

use stdClass;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Product
 * @package App\Bundles\Order\Entities
 * @property int id
 * @property string name
 * @property-read stdClass pivot
 */
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
