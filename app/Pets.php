<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    protected $fillable = [
        'id','pet_id','species_id','employee_id','birthdate',
    ];

    public function petname()
    {    
        //return "aaa";
        return $this->hasOne(PetNames::class, 'id', 'petx_id')->first();
        //return $this->belongsTo('App\PetNames');
    }
    public function employees(){
        return $this->hasOne(User::class, 'id', 'employee_id')->first();

    }
    public function species(){
        return $this->hasOne(Species::class, 'id', 'species_id')->first();
    }
}

//tabel pets