<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creatives extends Model
{
    //

    protected $fillable = [
        'CR_Name', 'CR_Filepath', 'CR_Width', 'CR_Height', 'CR_Description', 'CR_FK_US'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
