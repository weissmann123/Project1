<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetNamess extends Model
{
    public function species()
    {
        return $this->HasMany('App\PetTables');
    }
    protected $fillable = [
        'id','name','birthdate'
    ];
}

//tabel petnames