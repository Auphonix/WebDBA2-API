<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['firstName', 'lastName', 'email', 'isAdmin', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

}
