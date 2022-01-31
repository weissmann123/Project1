<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public function employees()
    {
        return $this->belongsToMany('App\User','roles_employees','role_id','employee_id');
        // return $this->belongsToMany(Employees::class, 'roles_employees', 'role_id', 'employee_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','role','user'
    ];
}