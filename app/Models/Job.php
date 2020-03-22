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
 * @property        int         paymentToShop
 * @property        int         paymentToSupplier
 * @property        Carbon      deliveryTime
 * @property        Carbon      acceptedJobTime
 * @property        ShoppingList    shoppingList
 * @property        string      shoppingList_id
 *
 * @property-read   Carbon      created_at
 * @property-read   Carbon      updated_at
 *
 * @package App\Models
 * @method static self create(array $all)
 */
class Job extends Model
{
    use UsesUuid;

    protected $fillable = [
        'status',
        'supplier_id',
        'consumer_id',
        'shoppingList_id',
        'shop_id',
        'receipt',
        'paymentToShop',
        'paymentToSupplier',
        'deliveryTime',
        'acceptedJobTime',
    ];

    protected $dates = ['acceptedJobTime'];

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

    public function shoppingList()
    {
        return $this->belongsTo(ShoppingList::class, 'shoppingList_id');
    }

}
