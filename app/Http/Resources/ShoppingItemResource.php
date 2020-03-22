<?php

namespace App\Http\Resources;

use App\Models\ShoppingItem;
use Illuminate\Http\Resources\Json\JsonResource;

class ShoppingItemResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var ShoppingItem $this */
        return [
            'id' => $this->id,
            'shoppingList_id' => $this->shoppingList_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'quantityUnit' => $this->quantityUnit,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
