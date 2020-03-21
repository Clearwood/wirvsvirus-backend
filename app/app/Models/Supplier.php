<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Supplier
 *
 * @property-read   string      id
 * @property        User        user
 * @property        string      user_id
 * @property        bool        hasCar
 * @property        bool        hasBike
 * @property        bool        hasCooler
 *
 * @property-read   Job[]           jobs
 * @property-read   ShopFeedback[]  shopFeedbacks
 *
 * @property-read   Carbon      created_at
 * @property-read   Carbon      updated_at
 *
 * @package App\Models
 */
class Supplier extends Model
{

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function shopFeedbacks(): HasMany
    {
        return $this->hasMany(ShopFeedback::class);
    }

}
