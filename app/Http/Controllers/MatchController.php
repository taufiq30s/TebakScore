<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\Team;
use App\Bet;
use App\User;
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

  private function updatePoint($status, $idMatch, $homeScore, $awayScore, $oldHomeScore, $oldAwayScore){
    $usersBet = Bet::where('idMatch', $idMatch)->get();
    // dd($usersBet->get());
    foreach($usersBet as $userBet){
      if($userBet->scorePredHome == $homeScore && $userBet->scorePredAway == $awayScore){
        $user = User::where('idUser', $userBet->idUser)->first();
        $user->points = $user->points+1;
        // dd($user->points);
        $user->save();
      }
      elseif($status == 1 && $userBet->scorePredHome == $oldHomeScore && $userBet->scorePredAway == $oldAwayScore){
        $user = User::where('idUser', $userBet->idUser)->first();
        if($user->points-1 >= 0)
          $user->points = $user->points-1;
        $user->save();
      }
    }
  }

  public function updateScore(Request $req, $idMatch){
    $match = Match::where('idMatch', $idMatch)->first();
    $match->setKeyName('idMatch');
      if($match->isSetted == 0){
        $match->isSetted = 1;
        $this->updatePoint(0, $idMatch, $req->homeScore, $req->awayScore, $match->scoreTeamHome, $match->scoreTeamAway);
      }
      else $this->updatePoint(1, $idMatch, $req->homeScore, $req->awayScore, $match->scoreTeamHome, $match->scoreTeamAway);
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
