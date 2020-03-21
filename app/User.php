<?php

namespace App;

use App\Models\Consumer;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @property-read   string  id
 * @property        string  firstName
 * @property        string  lastName
 * @property        string  email
 * @property        Carbon  birthday
 * @property        string  streetName
 * @property        string  houseNumber
 * @property        string  city
 * @property        int     postCode
 * @property        string  extraAddressInformation
 * @property        string  healthStatus
 * @property        bool    isRiskGroup
 * @property        string  password
 * @property        float   latitude
 * @property        float   longitude
 *
 * @property-read   Consumer    consumer
 * @property-read   Supplier    supplier
 *
 * @property-read   Carbon  created_at
 * @property-read   Carbon  updated_at
 *
 * @package App
 * @method static self create(array $all)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'birthday',
        'streetName',
        'houseNumber',
        'city',
        'postCode',
        'extraAddressInformation',
        'healthStatus',
        'isRiskGroup'
        //'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function consumer(): HasOne
    {
        return $this->hasOne(Consumer::class);
    }

    public function supplier(): HasOne
    {
        return $this->hasOne(Supplier::class);
    }
}
