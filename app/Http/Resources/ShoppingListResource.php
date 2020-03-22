<?php

namespace App\Http\Resources;

use App\Models\ShoppingList;
use Illuminate\Http\Resources\Json\JsonResource;

class ShoppingListResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var ShoppingList $this */
        return [
            'id' => $this->id,
            'consumer_id' => $this->consumer_id,
            'preferCheapProducts' => $this->preferCheapProducts,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
