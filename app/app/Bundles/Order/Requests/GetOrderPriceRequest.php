<?php

namespace App\Bundles\Order\Requests;

use Illuminate\Validation\Rule;
use App\Bundles\Order\Entities\Product;
use Illuminate\Foundation\Http\FormRequest;

class GetOrderPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cart' => ['required', 'array', 'min:1'],
            'cart.*' => ['required', 'array'],
            'cart.*.product_id' => ['required', Rule::exists(Product::class, 'id')->where('is_available', true)],
            'cart.*.amount' => ['required', 'integer', 'min:1']
        ];
    }
}
