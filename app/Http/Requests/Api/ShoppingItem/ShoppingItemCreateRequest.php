<?php

namespace App\Http\Requests\Api\Job;

use App\Http\Requests\Api\BaseRequest;
use App\Models\Consumer;
use App\Models\Product;
use App\Models\ShoppingList;

class ShoppingItemCreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shoppingList_id' => 'required|exists:' . ShoppingList::class . ',id',
            'product_id' => 'required|exists:' . Product::class . ',id',
            'quantity' => 'required|numeric',
        ];
    }
}
