<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Places extends Model
{
    //
    protected $fillable = [
        'PL_NAme', 'PL_Type'
    ];

    public function people()
    {
        return $this->hasMany('App\People','PE_FK_PL');
    }

    public function companies()
    {
        return $this->hasMany('App\Companies', 'CO_FK_PL');
    }
}
