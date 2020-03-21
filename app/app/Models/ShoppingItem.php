<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShoppingItem
 *
 * @property-read   string          id
 * @property        ShoppingList    shoppingList
 * @property        string          shoppingList_id
 * @property        Product         product
 * @property        string          product_id
 * @property        float           quantity
 * @property        string          quantityUnit
 *
 * @property-read   Carbon          created_at
 * @property-read   Carbon          updated_at
 *
 * @package App\Models
 */
class ShoppingItem extends Model
{

    public function shoppingList()
    {
        return $this->belongsTo(ShoppingList::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
