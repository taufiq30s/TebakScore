<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = [];
    protected $table = "team";
    public $timestamps = false;

    public function matchHome(){
        return $this->hasMany(Match::class, 'idTeamHome', 'idTeam');
    }

    public function matchAway(){
        return $this->hasMany(Match::class, 'idTeamAway', 'idTeam');
    }
}
