<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    public function roles()
    {
        return $this->belongsToMany('App\Roles','roles_employees','employee_id','role_id');
        // return $this->belongsToMany(Roles::class, 'roles_employees', 'employee_id', 'role_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','email',
    ];
}
