<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    public function roles()
    {
        return $this->belongsToMany('App\Roles','roles_employees','employee_id','role_id');
        // return $this->belongsToMany(Roles::class, 'roles_employees', 'employee_id', 'role_id');
    }

    public function pets()
    {
        return $this->HasMany('App\Pets','user_id','id');
        // return $this->belongsToMany(Roles::class, 'roles_employees', 'employee_id', 'role_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
