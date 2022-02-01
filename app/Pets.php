<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    protected $fillable = [
        'id','petname_id','species_id','employee_id','birthdate',
    ];

    public function petnames(){    
        return $this->belongsTo('App\PetNames','petname_id','id');
    }
    public function employees(){
        return $this->belongsTo('App\User','employee_id','id');
    }
    public function species(){
        return $this->belongsTo('App\Species');
    }
}