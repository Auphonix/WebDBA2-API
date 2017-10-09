<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content'];

    public function ticket(){
        return $this->belongsTo('App\Ticket', 'ticketID');
    }

    public function techUser(){
        return $this->belongsTo('App\TechUser', 'techUserID');
    }
}
