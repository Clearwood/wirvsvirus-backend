<?php

namespace App\Http\Requests\Api\ShoppingList;

use App\Http\Requests\Api\BaseRequest;
use App\Models\Consumer;

class ShoppingListCreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'consumer_id' => 'required|exists:' . Consumer::class . ',id',
            'preferCheapProducts' => 'boolean',
            'shopType' => 'required|string',
            'shoppingBagsAmount' => 'required|integer',
        ];
    }
}
