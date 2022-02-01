<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetNames extends Model
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