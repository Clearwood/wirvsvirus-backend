<?php

namespace App\Http\Requests\Api\Job;

use App\Http\Requests\Api\BaseRequest;
use App\Models\Consumer;
use App\Models\Product;
use App\Models\ShoppingList;

class ShoppingItemUpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'numeric',
        ];
    }
}
