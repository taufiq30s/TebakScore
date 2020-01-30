<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\Team;
use Illuminate\Auth\Events\Registered;
use \Validator;


class MatchController extends Controller
{
  public function index()
  {
    $matches = Match::all();
    return view('admin/match/index', ['matches' => $matches]);
  }

  public function create()
  {
    $match = new Match();
    $teams = Team::all();
    return view('admin/match/form', ['match' => $match, 'teams' => $teams, 'matchStarted' => false]);
  }

  protected function validator(array $data)
  {
    return Validator::make($data, [
      'matchTime' => ['required'],
    ]);
  }

  private function store(array $data)
  {
    $matchTime = date( "Y-m-d H:i:s", strtotime( $data['matchTime'] ) );
    return Match::create([
      'idTeamHome' => $data['homeTeam'],
      'idTeamAway' => $data['awayTeam'],
      'matchTime' => $matchTime,
      'scoreTeamHome' => -1,
      'scoreTeamAway' => -1
    ]);
  }

  public function register(Request $req)
  {
    $this->validator($req->all())->validate();
    event(new Registered($match = $this->store($req->all())));
    return redirect()->route('matchArea');
  }

  public function edit($idMatch){
    $match = Match::where('idMatch', $idMatch)->first();
    $teams = Team::all();
    return view('admin/match/form', ['match' => $match, 'teams' => $teams, 'matchStarted' => false]);
  }

  public function update(Request $req, $idMatch){
    $match = Match::where('idMatch', $idMatch)->first();
    $this->validator($req->all())->validate();
    $matchTime = date( "Y-m-d H:i:s", strtotime( $req['matchTime'] ) );
    $match->setKeyName('idMatch');
    $match->idTeamHome = $req['homeTeam'];
    $match->idTeamAway = $req['awayTeam'];
    $match->matchTime = $matchTime;
    $match->save();
    return redirect()->route('matchArea');
  }

  public function score($idMatch){
    $match = Match::where('idMatch', $idMatch)->first();
    $teams = Team::all();
    if($match->scoreTeamHome == -1) $match->scoreTeamHome = 0;
    if($match->scoreTeamAway == -1) $match->scoreTeamAway = 0;
    return view('admin/match/form', ['match' => $match, 'teams' => $teams, 'matchStarted' => true]);
  }

  public function updateScore(Request $req, $idMatch){
    $match = Match::where('idMatch', $idMatch)->first();
    $match->setKeyName('idMatch');
    $match->scoreTeamHome = $req->homeScore;
    $match->scoreTeamAway = $req->awayScore;
    $match->save();
    return redirect()->route('matchArea');
  }

  public function destroy($idMatch){
    $match = Match::where('idMatch', $idMatch)->first()->setKeyName('idMatch');
    $match->delete();
    return redirect()->route('matchArea');
  }
}
