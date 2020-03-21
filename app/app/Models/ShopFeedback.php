<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShopFeedback
 *
 * @property-read   string      id
 * @property        Shop        shop
 * @property        string      shop_id
 * @property        Supplier    supplier
 * @property        string      supplier_id
 * @property        string      amountOfCustomers
 * @property        string      productAvailability
 *
 * @property-read   Carbon      created_at
 * @property-read   Carbon      updated_at
 *
 * @package App\Models
 */
class ShopFeedback extends Model
{
    use UsesUuid;

    protected $fillable = [
        'shop_id',
        'supplier_id',
        'amountOfCustomers',
        'productAvailability',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

}
