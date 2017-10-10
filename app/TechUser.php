<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechUser extends Model
{
    protected $fillable = ['firebaseId', 'firebaseName'];

    public function comments(){
        return $this->hasMany('App\Comment', 'techUserID');
    }

    public function techTicketHandlers(){
        return $this->hasMany('App\TechTicketHandler', 'techUserID');
    }
}
