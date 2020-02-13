@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Manage Match</div>
        <div class="card-body">
          <a href="match/add" class="btn btn-primary">Tambah Match</a>
          <br><br>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Id Match</th>
                <th scope="col">Nama Tim Rumah</th>
                <th scope="col">Nama Tim Tamu</th>
                <th scope="col">Score Tim Rumah</th>
                <th scope="col">Score Tim Tamu</th>
                <th scope="col">Waktu Match</th>
                <th scope="col" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($matches as $match)
              <tr>
                <td>{{$match->idMatch}}</td>
                <td>{{$match->home->nameTeam}}</td>
                <td>{{$match->away->nameTeam}}</td>
                <td>
                  @if($match->scoreTeamHome == -1)
                  -
                  @else
                  {{$match->scoreTeamHome}}
                  @endif
                </td>
                <td>
                  @if($match->scoreTeamAway == -1)
                  -
                  @else
                  {{$match->scoreTeamAway}}
                  @endif
                </td>
                <td>{{date( "d-m-Y H:i", strtotime( $match->matchTime ) )}}</td>
                @if((Carbon\Carbon::parse($match->matchTime)->addMinutes(90))->greaterThan(Carbon\Carbon::now()))
                <td>
                  <a href="{{action('MatchController@edit', $match['idMatch'])}}" class="btn btn-warning btn-sm {{ !(Carbon\Carbon::parse($match->matchTime)->greaterThan(Carbon\Carbon::now())) ? 'disabled' : '' }}">Edit</a>
                </td>
                <td>
                  <form class="delete" onsubmit="return confirm('Anda yakin ingin menghapus match ini?');" action="{{action('MatchController@destroy', $match['idMatch'])}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <input class="btn btn-danger btn-sm" type="submit" value="Hapus">
                  </form>
                </td>
                @else
                <td>
                  <a href="{{action('MatchController@score', $match['idMatch'])}}" class="btn btn-info btn-sm {{ ((Carbon\Carbon::parse($match->matchTime)->addMinutes(90))->greaterThan(Carbon\Carbon::now())) ? 'disabled' : '' }}">Set Score</a>
                </td>
                @endif
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