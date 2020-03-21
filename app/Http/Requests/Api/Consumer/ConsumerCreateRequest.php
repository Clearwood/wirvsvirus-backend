<?php

namespace App\Http\Requests\Api\ShoppingList;

use App\Http\Requests\Api\BaseRequest;
use App\User;

class ConsumerCreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:' . User::class . ',id',
        ];
    }
}
