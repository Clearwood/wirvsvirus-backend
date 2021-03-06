<?php

namespace App\Http\Requests\Api\ShoppingList;

use App\Http\Requests\Api\BaseRequest;
use App\Models\Consumer;

class ShoppingListUpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'preferCheapProducts' => 'boolean',
            'shopType' => 'string',
            'shoppingBagsAmount' => 'integer'
        ];
    }
}
