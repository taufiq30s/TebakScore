<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use App\Bet;
use Auth;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;

class TebakController extends Controller
{
  public function index(){
    $matches = Match::all();
    $test = $matches->first();
    // dd($matches);
    return view('member/tebak/index', ['matches' => $matches]);
  }

  public function create($idMatch){
    return view('member/tebak/form', ['idMatch' => $idMatch, 'edit' => 0]);
  }
  

  public function register($idMatch, Request $req){
    $user = Auth::user()->idUser;
    $data = $req->all();
    event(new Registered($bet = Bet::create([
        'idUser' => $user,
        'idMatch' => $idMatch,
        'scorePredHome' => $data['homePredScore'],
        'scorePredAway' => $data['awayPredScore']
    ])));
    return redirect()->route('tebak');
  }

  public function edit($idMatch){
    $user = Auth::user()->idUser;
    $data = Bet::where(['idUser' => $user, 'idMatch' => $idMatch])->first();
    return view('member/tebak/form', ['idMatch' => $idMatch, 'data' => $data, 'edit' => 1]);
  }

  public function update($idMatch, Request $req){
    $user = Auth::user()->idUser;
    $bet = Bet::where(['idUser' => $user, 'idMatch' => $idMatch])->first();
    // $idBet = $bet->idBet;
    $bet->setKeyName('idBetting');
    $bet->scorePredHome = $req->homePredScore;
    $bet->scorePredAway = $req->awayPredScore;
    $bet->save();
    return redirect()->route('tebak');
  }
}
