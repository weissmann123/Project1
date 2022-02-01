<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    //
    public function pets()
    {
        return $this->hasMany('App\Pets','species_id','id');
    }
    protected $fillable = [
        'id','name'
    ];
    //Model = plural
    //table column = singular
}
