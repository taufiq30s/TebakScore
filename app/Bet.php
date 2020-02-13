<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $guarded = [];
    protected $table = "bet";

    const CREATED_AT = 'bettingTime';
    const UPDATED_AT = 'bettingTime'; 

    public function matchData(){
        return $this->belongsTo(Match::class, 'idMatch', 'idMatch');
    }

    public function userData(){
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
}
