<?php

namespace App;

use App\Models\Consumer;
use App\Models\Supplier;
use App\Models\UsesUuid;
use App\services\DistanceService;
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
 * @property        string  phoneNumber
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
    use Notifiable, UsesUuid;

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
        'isRiskGroup',
        'phoneNumber',
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

    public function getLatLong()
    {
        if ($this->isDirty(['streetName', 'houseNumber', 'city', 'postcode']) || $this->wasRecentlyCreated) {
            $ds = new DistanceService();
            $res = $ds->address2Geo($this->getAddress());
            $this->latitude = $res['json']['results'][0]['geometry']['location']['lat'];
            $this->longitude = $res['json']['results'][0]['geometry']['location']['lng'];
        }
    }

    public function getAddress()
    {
        return "{$this->streetName} {$this->houseNumber}, {$this->postCode} {$this->city}, Germany";
    }

    public static function boot()
    {
        parent::boot();
        static::saving(function (User $user) {
            $user->getLatLong();
        });
    }
}
