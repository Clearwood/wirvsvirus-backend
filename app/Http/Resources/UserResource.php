<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var User $this */
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'birthday' => $this->birthday,
            'streetName' => $this->streetName,
            'houseNumber' => $this->houseNumber,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'city' => $this->city,
            'postCode' => $this->postCode,
            'extraAddressInformation' => $this->extraAddressInformation,
            'healthStatus' => $this->healthStatus,
            'isRiskGroup' => $this->isRiskGroup,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
