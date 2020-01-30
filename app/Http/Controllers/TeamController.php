<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use Illuminate\Auth\Events\Registered;
use \Validator;

class TeamController extends Controller
{
  public function index()
  {
    $teams = Team::all();
    return view ('admin/team/index', ['teams' => $teams]);
  }

  protected function validator(array $data){
    return Validator::make($data, [
      'namaTeam' => ['required', 'string', 'max:50'],
      'leagueTeam' => ['required', 'string', 'max:100'],
      'typeTeam' => ['required', 'string', 'max:50']
    ]);
  }

  public function create(){
    $team = new Team();
    return view('admin/team/form', ['team' => $team]);
  }

  private function store(array $data){
    return Team::create([
      'nameTeam' => $data['namaTeam'],
      'leagueTeam' => $data['leagueTeam'],
      'typeTeam' => $data['typeTeam']
    ]);
  }

  public function register(Request $req){
    $this->validator($req->all())->validate();
    event(new Registered($team = $this->store($req->all())));
    return redirect()->route('teamArea');
  }

  public function edit($idTeam){
    $team = Team::where('idTeam', $idTeam)->first();
    return view('/admin/team/form', ['team' => $team]);
  }

  public function update(Request $req, $idTeam){
    $team = Team::where('idTeam', $idTeam)->first();
    $this->validator($req->all())->validate();
    $team->setKeyName('idTeam');
    $team->nameTeam = $req->namaTeam;
    $team->leagueTeam = $req->leagueTeam;
    $team->typeTeam = $req->typeTeam;
    $team->save();
    return redirect()->route('teamArea');
  }

  public function destroy($idTeam){
    $team = Team::where('idTeam', $idTeam)->first()->setKeyName('idTeam');
    $team->delete();
    return redirect()->route('teamArea');
  }
}
