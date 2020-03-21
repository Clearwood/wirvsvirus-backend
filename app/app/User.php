<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
 *
 * @property-read   Carbon  created_at
 * @property-read   Carbon  updated_at
 *
 * @package App
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
        'name', 'email', 'password',
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
}
