<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN_TYPE = 1;
    const DEFAULT_TYPE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'US_Credits', 'US_isCompany'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'US_Password', 'US_isAdmin', 'remember_token'
    ];

    
    public function isAdmin()
    {
        return $this->US_isAdmin === self::ADMIN_TYPE;
    }

    public function people()
    {
        return $this->hasOne('\App\People', 'PE_FK_US');
    }

    public function companies()
    {
        return $this->hasOne('\App\Companies', 'CO_FK_US');
    }

    public function creatives()
    {
        // return $this->hasMany('\App\Companies', 'CR_FK_US');
    }

    public function payments()
    {
        return $this->hasMany('\App\Payments', 'PA_FK_US')->orderBy('created_at', 'desc');
    }

}
