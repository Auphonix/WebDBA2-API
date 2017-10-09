<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['operatingSystem', 'status', 'issue', 'description', 'priority', 'escalationLevel'];

    public function user(){
        return $this->belongsTo('App\User', 'id');
    }

    public function comment(){
        return $this->hasMany('App\Comment', 'id');
    }

    public function techTicketHandler(){
        return $this->hasOne('App\TechTicketHandler', 'id');
    }
}
