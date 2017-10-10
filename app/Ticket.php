<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['operatingSystem', 'status', 'issue', 'description', 'priority', 'escalationLevel'];

    public function user(){
        return $this->belongsTo('App\User', 'userID');
    }

    public function comment(){
        return $this->hasMany('App\Comment', 'ticketID');
    }

    public function techTicketHandler(){
        return $this->hasOne('App\TechTicketHandler', 'ticketID');
    }
}
