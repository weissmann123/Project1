<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    protected $fillable = [
        'id','petName_id','species_id','employee_id','birthdate',
    ];

    public function names(){    
        return $this->belongsTo('App\Pets');
    }
    public function employees(){
        return $this->belongsTo('App\Employees');
    }
    public function species(){
        return $this->belongsTo('App\Species');
    }
}

//tabel pets