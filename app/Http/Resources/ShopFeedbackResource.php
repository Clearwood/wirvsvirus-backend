<?php

namespace App\Http\Resources;

use App\Models\ShopFeedback;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopFeedbackResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var ShopFeedback $this */
        return [
            'id' => $this->id,
            'shop_id' => $this->shop_id,
            'supplier_id' => $this->supplier_id,
            'amountOfCustomers' => $this->amountOfCustomers,
            'productAvailability' => $this->productAvailability,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
