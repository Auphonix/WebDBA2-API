<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechUser extends Model
{
    protected $fillable = ['firebaseId', 'firebaseName'];

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function techTicketHandlers(){
        return $this->hasMany('App\TechTicketHandler', 'id');
    }
}
