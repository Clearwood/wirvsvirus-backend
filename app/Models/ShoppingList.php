<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ShoppingList
 *
 * @property-read   string      id
 * @property        Consumer    consumer
 * @property        string      consumer_id
 * @property        bool        preferCheapProducts
 * @property        string      shopType
 * @property        boolean     hasCooledProduct
 * @property        int         shoppingBagsAmount
 *
 * @property-read   ShoppingItem[]  shoppingItems
 *
 * @property-read   Carbon      created_at
 * @property-read   Carbon      updated_at
 *
 * @package App\Models
 * @method static self create(array $all)
 */
class ShoppingList extends Model
{
    use UsesUuid;

    protected $fillable = [
        'consumer_id',
        'shopType',
        'shoppingBagsAmount',
    ];

    public function consumer()
    {
        return $this->belongsTo(Consumer::class);
    }

    public function shoppingItems(): HasMany
    {
        return $this->hasMany(ShoppingItem::class);
    }

}
