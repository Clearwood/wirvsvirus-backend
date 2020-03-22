<?php

namespace App\Http\Requests\Api\Job;

use App\Http\Requests\Api\BaseRequest;
use App\Models\Consumer;
use App\Models\ShoppingList;

class JobCreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => 'in:pending,inProgress,done,cancelled',
            'shoppingList_id' => 'required|exists:' . ShoppingList::class . ',id',
        ];
    }
}
