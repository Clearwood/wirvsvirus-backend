<?php

namespace App\Http\Requests\Api\Job;

use App\Http\Requests\Api\BaseRequest;
use App\Models\Consumer;

class ProductCreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'tags' => 'array',
            'shopType' => 'required|string',
            'quantityUnit' => 'required|string',
            'priceRangeMin' => 'required|integer',
            'priceRangeMax' => 'required|integer',
        ];
    }
}
