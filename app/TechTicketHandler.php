<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechTicketHandler extends Model
{
    public function techUser(){
        return $this->belongsTo('App\TechUser', 'techUserID');
    }

    public function ticket(){
        return $this->belongsTo('App\Ticket', 'ticketID');
    }
}
