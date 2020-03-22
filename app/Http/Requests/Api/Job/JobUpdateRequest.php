<?php

namespace App\Http\Requests\Api\Job;

use App\Http\Requests\Api\BaseRequest;
use App\Models\Consumer;
use App\Models\Shop;
use App\Models\Supplier;

class JobUpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => 'in:pending,inProgress,done,cancelled',
            'supplier_id' => 'nullable|exists:' . Supplier::class . ',id',
            'shop_id' => 'nullable|exists:' . Shop::class . ',id',
            'receipt' => 'nullable|url',
            'paymentToShop' => 'nullable|integer',
            'paymentToSupplier' => 'nullable|integer',
            'acceptedJobTime' => 'nullable|datetime',
        ];
    }
}
