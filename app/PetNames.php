<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetNames extends Model
{
    public function pets()
    {
        return $this->HasMany('App\Pets','petname_id','id');
    }
    protected $fillable = [
        'id','name',
    ];
}
