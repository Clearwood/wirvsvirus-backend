<?php

namespace App\Http\Requests\Api\Job;

use App\Http\Requests\Api\BaseRequest;
use App\Models\Consumer;

class ProductUpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'tags' => 'array',
            'quantityUnit' => 'string',
            'priceRangeMin' => 'integer',
            'priceRangeMax' => 'integer',
        ];
    }
}
