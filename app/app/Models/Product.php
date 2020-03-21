<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Product
 *
 * @property-read   string      id
 * @property        string      name
 * @property        array       tags
 *
 * @property-read   ShoppingItem[]  shoppingItems
 * @property-read   Shop[]          shops
 *
 * @property-read   Carbon      created_at
 * @property-read   Carbon      updated_at
 *
 * @package App\Models
 */
class Product extends Model
{
    use UsesUuid;

    protected $casts = [
        'tags' => 'array',
    ];

    public function shoppingItems(): HasMany
    {
        return $this->hasMany(ShoppingItem::class);
    }

    public function shops(): BelongsToMany
    {
        return $this->belongsToMany(Shop::class, 'shop_product')->withPivot('isAvailable')->withTimestamps();
    }

}
