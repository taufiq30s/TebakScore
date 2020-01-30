@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Manage Team</div>
        <div class="card-body">
          @if(!isset($team->idTeam))
          <form action="/admin/team" method="post">
          @else
          <form action="/admin/team/{{$team->idTeam}}" method="post">
          @endif
            @csrf
            <div class="form-group row">
              <label for="namaTeam" class="col-md-4 col-form-label text-md-right">{{__('Nama Tim')}}</label>
              <div class="col-md-6">
                <input type="namaTeam" id="namaTeam" class="form-control {{ $errors->has('namaTeam') ? ' is-invalid' : '' }}" name="namaTeam" value="{{ $team->nameTeam }}" required>
                @if ($errors->has('namaTeam'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('namaTeam') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="leagueTeam" class="col-md-4 col-form-label text-md-right">{{__('Liga Tim')}}</label>
              <div class="col-md-6">
                <input type="leagueTeam" id="leagueTeam" class="form-control {{ $errors->has('leagueTeam') ? ' is-invalid' : '' }}" name="leagueTeam" value="{{ $team->leagueTeam }}"  required>
                @if ($errors->has('leagueTeam'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('leagueTeam') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="typeTeam" class="col-md-4 col-form-label text-md-right">{{__('Tipe Tim')}}</label>
              <div class="col-md-6">
                <input type="typeTeam" id="typeTeam" class="form-control {{ $errors->has('typeTeam') ? ' is-invalid' : '' }}" name="typeTeam" value="{{ $team->typeTeam }}"  required>
                @if ($errors->has('typeTeam'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('typeTeam') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  @if(!isset($team->idTeam))
                  {{ __('Tambah') }}
                  @else
                  {{ __('Edit') }}
                  @endif
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection