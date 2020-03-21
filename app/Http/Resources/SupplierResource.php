<?php

namespace App\Http\Resources;

use App\Models\Supplier;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var Supplier $this */
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'hasCar' => $this->hasCar,
            'hasBike' => $this->hasBike,
            'hasCooler' => $this->hasCooler,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
