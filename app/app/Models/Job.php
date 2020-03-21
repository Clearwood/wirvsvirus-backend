<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Job
 *
 * @property-read   string      id
 * @property        string      status
 * @property        Supplier    supplier
 * @property        string      supplier_id
 * @property        Consumer    consumer
 * @property        string      consumer_id
 * @property        Shop        shop
 * @property        string      shop_id
 * @property        string      receipt
 * @property        int         paymentForShop
 * @property        int         paymentForSupplier
 * @property        Carbon      deliveryTime
 * @property        Carbon      acceptedJobTime
 *
 * @property-read   Carbon      created_at
 * @property-read   Carbon      updated_at
 *
 * @package App\Models
 */
class Job extends Model
{

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function consumer()
    {
        return $this->belongsTo(Consumer::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

}
