<?php

namespace App\Http\Resources;

use App\Models\Job;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var Job $this */
        return [
            'id' => $this->id,
            'supplier_id' => $this->supplier_id,
            'consumer_id' => $this->consumer_id,
            'shop_id' => $this->shop_id,
            'receipt' => $this->receipt,
            'paymentToShop' => $this->paymentToShop,
            'paymentToSupplier' => $this->paymentToSupplier,
            'deliveryTime' => $this->deliveryTime,
            'acceptedJobTime' => $this->acceptedJobTime,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
