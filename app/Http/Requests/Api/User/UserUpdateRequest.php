<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseRequest;

class UserUpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => 'string',
            'lastName' => 'string',
            'email' => 'email',
            'birthday' => 'date',
            'streetName' => 'string',
            'houseNumber' => 'string',
            'city' => 'string',
            'postCode' => 'integer',
            'extraAddressInformation' => 'string',
            'healthStatus' => 'in:quarantine,sick,healthy',
            'isRiskGroup' => 'boolean',
            'password' => 'string',
        ];
    }
}
