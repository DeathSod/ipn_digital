<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    //

    protected $fillable = [
        'PE_Name', 'PE_LastName', 'PE_FK_US', 'PE_FK_PL'
    ];
}
