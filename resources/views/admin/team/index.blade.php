@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Manage Team</div>
        <div class="card-body">
          <a href="team/add" class="btn btn-primary">Tambah Team</a>
          <br><br>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Id Tim</th>
                <th scope="col">Nama Tim</th>
                <th scope="col">League Tim</th>
                <th scope="col">Tipe Tim</th>
                <th scope="col" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($teams as $team)
              <tr>
                <td>{{$team->idTeam}}</td>
                <td>{{$team->nameTeam}}</td>
                <td>{{$team->leagueTeam}}</td>
                <td>{{$team->typeTeam}}</td>
                <td>
                  <a href="{{action('TeamController@edit', $team['idTeam'])}}" class="btn btn-warning btn-sm">Edit</a>
                </td>
                <td>
                  <form class="delete" onsubmit="return confirm('Anda yakin ingin menghapus tim ini?');" action="{{action('TeamController@destroy', $team['idTeam'])}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <input class="btn btn-danger btn-sm" type="submit" value="Hapus">
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection