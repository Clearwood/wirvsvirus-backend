<?php

namespace App\Http\Resources;

use App\Models\Shop;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var Shop $this */
        return [
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'streetName' => $this->streetName,
            'houseNumber' => $this->houseNumber,
            'city' => $this->city,
            'postCode' => $this->postCode,
            'extraAddressInformation' => $this->extraAddressInformation,
            'brand' => $this->brand,
            'name' => $this->name,
            'type' => $this->type,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
