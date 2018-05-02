<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    //

    protected $fillable = [
        'CO_Name', 'CO_ContactName', 'CO_ContactLastName', 'CO_Website', 'CO_WorkArea', 'CO_FK_US', 'CO_FK_PL'
    ];

    public function user()
    {
        return $this->belongsTo()('App\User');
    }
}
