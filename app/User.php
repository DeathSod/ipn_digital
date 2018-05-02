<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        return $this->isAdmin === 1;
    }

    public function people()
    {
        return $this->hasOne('\App\People', 'PE_FK_US');
    }

    public function companies()
    {
        return $this->hasOne('\App\Companies', 'CO_FK_US');
    }

}
