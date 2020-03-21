<?php

namespace App\Http\Requests\Api\ShoppingList;

use App\Http\Requests\Api\BaseRequest;
use App\Models\Consumer;
use App\User;

class SupplierUpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hasCar' => 'boolean',
            'hasBike' => 'boolean',
            'hasCooler' => 'boolean',
        ];
    }
}
