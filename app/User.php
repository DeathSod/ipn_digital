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
        'US_Email', 'US_Password', 'US_Credits', 'US_isCompany'
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

}
