<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Shop
 *
 * @property-read   string      id
 * @property        float       latitude
 * @property        float       longitude
 * @property        string      streetName
 * @property        string      houseNumber
 * @property        string      city
 * @property        int         postCode
 * @property        string      extraAddressInformation
 * @property        string      brand
 * @property        string      name
 * @property        string      type
 *
 * @property-read   Job[]           jobs
 * @property-read   ShopFeedback[]  shopFeedbacks
 * @property-read   Product[]       products
 *
 * @property-read   Carbon      created_at
 * @property-read   Carbon      updated_at
 *
 * @package App\Models
 */
class Shop extends Model
{
    use UsesUuid;

    protected $fillable = [
        'latitude',
        'longitude',
        'streetName',
        'houseNumber',
        'city',
        'postCode',
        'extraAddressInformation',
        'brand',
        'name',
        'type',
    ];

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function shopFeedbacks(): HasMany
    {
        return $this->hasMany(ShopFeedback::class, 'shopFeedback_id');
    }

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'shop_product')->withPivot('isAvailable')->withTimestamps();
    }

}
