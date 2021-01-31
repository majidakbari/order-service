<?php

namespace App\Bundles\Order\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductResource
 * @package App\Bundles\Order\Resources
 * @property int id
 * @property string name
 * @property float price
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_a' => $this->created_at->toDateTimeString()
        ];
    }
}
