<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\BaseRequest;

class UserCreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
            'birthday' => 'required|datetime',
            'streetName' => 'required|string',
            'houseNumber' => 'required|string',
            'city' => 'required|string',
            'postCode' => 'required|integer',
            'extraAddressInformation' => 'string',
            'healthStatus' => 'required|in:quarantine,sick,healthy',
            'isRiskGroup' => 'required|boolean',
            'password' => 'required|string',
            'phoneNumber' => 'required|string',
        ];
    }
}
