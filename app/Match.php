<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $guarded = [];
    protected $table = "match";
    public $timestamps = false;

    public function home(){
        return $this->belongsTo(Team::class, 'idTeamHome', 'idTeam');
    }

    public function away(){
        return $this->belongsTo(Team::class, 'idTeamAway', 'idTeam');
    }

    public function betMatch(){
        return $this->hasMany(Bet::class, 'idMatch', 'idMatch');
    }
}
