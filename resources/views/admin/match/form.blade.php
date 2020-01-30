@extends('layouts.head')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Manage Match</div>
        <div class="card-body">
          @if(!isset($match->idMatch))
          <form action="/admin/match" method="post" id="matchForm">
            @else
            <form action="/admin/match/{{$matchStarted ? 'score/' : ''}}{{$match->idMatch}}" method="post" id="matchForm">
              @endif
              @csrf
              <div class="form-group row">
                <label for="homeTeam" class="col-md-4 col-form-label text-md-right">{{__('Nama Tim Rumah')}}</label>
                <div class="col-md-6">
                  <select name="homeTeam" id="homeTeam" class="form-control {{ $errors->has('homeTeam') ? ' is-invalid' : '' }}" required {{$matchStarted ? 'disabled' : ''}}>
                    <option value="">Pilih Tim Rumah</option>
                    @foreach($teams as $team)
                    <option value="{{$team->idTeam}}" {{($match->idTeamHome == $team->idTeam) ? 'selected' : ''}}>{{$team->nameTeam}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('homeTeam'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('homeTeam') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="awayTeam" class="col-md-4 col-form-label text-md-right">{{__('Nama Tim Tamu')}}</label>
                <div class="col-md-6">
                  <select name="awayTeam" id="awayTeam" class="form-control {{ $errors->has('awayTeam') ? ' is-invalid' : '' }}" required {{$matchStarted ? 'disabled' : ''}}>
                    <option value="">Pilih Tim Tamu</option>
                    @foreach($teams as $team)
                    <option value="{{$team->idTeam}}" {{($match->idTeamAway == $team->idTeam) ? 'selected' : ''}}>{{$team->nameTeam}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('awayTeam'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('awayTeam') }}</strong>
                  </span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="matchTime" class="col-md-4 col-form-label text-md-right">{{__('Waktu Match')}}</label>
                <div class="col-md-6">
                  <div class="input-group date" id="datePicker" >
                    <input type="text" id="matchTime" class="form-control" name="matchTime" data="{{$match->matchTime}}" required {{$matchStarted ? 'disabled' : ''}}>
                    <span class="input-group-addon btn btn-primary" {{$matchStarted ? 'disabled' : ''}}>
                      <i class="far fa-calendar-alt"></i>
                    </span>
                    @if ($errors->has('matchTime'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('matchTime') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>

              @if(isset($match->idMatch) && $matchStarted)
              <div class="form-group row">
                <label for="homeScore" class="col-md-4 col-form-label text-md-right">{{__('Score Tim Rumah')}}</label>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-danger btn-number btnHome" data-type="minus" data-field="homeScore" disabled>
                        <i class="fas fa-minus-circle"></i>
                      </button>
                    </span>
                    <input type="text" class="form-control input-number {{ $errors->has('homeScore') ? ' is-invalid' : '' }}" name="homeScore" value="{{ $match->scoreTeamHome }}" required  min="0" max="100">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="homeScore">
                        <i class="fas fa-plus-circle"></i>
                      </button>
                    </span>
                    @if ($errors->has('homeScore'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('homeScore') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="awayScore" class="col-md-4 col-form-label text-md-right">{{__('Score Tim Tamu')}}</label>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-danger btn-number btnAway" data-type="minus" data-field="awayScore" disabled>
                        <i class="fas fa-minus-circle"></i>
                      </button>
                    </span>
                    <input type="text" class="form-control input-number {{ $errors->has('awayScore') ? ' is-invalid' : '' }}" name="awayScore" value="{{ $match->scoreTeamAway }}" required value="0" min="0" max="100">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="awayScore">
                        <i class="fas fa-plus-circle"></i>
                      </button>
                    </span>
                    @if ($errors->has('awayScore'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('awayScore') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
              @endif

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary" id="matchBtnSubmit">
                    @if(!isset($match->idMatch))
                    {{ __('Tambah') }}
                    @elseif(!$matchStarted)
                    {{ __('Edit') }}
                    @else
                    {{ __('Set Score') }}
                    @endif
                  </button>
                  <a href="{{ url()->route('matchArea') }}" class="btn btn-danger">Kembali</a>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection