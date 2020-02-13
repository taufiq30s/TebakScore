@extends('layout')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1 class="mt-5 mb-5">Daftar Pertandingan</h1>
      <table class="table table-hover table-striped" id="dtblListMatch">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Liga</th>
            <th scope="col">Tebakan</th>
            <th scope="col">Skor Akhir</th>
            <th scope="col">Waktu Match</th>
            <th scope="col">Hasil</th>
            <th scope="col">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $num = 1; $tebakData = null; ?>
          @foreach($matches as $match)
          <tr>
            <th scope="row">{{$num++}}</th>
            <td>{{ $match->home->nameTeam }} vs {{$match->away->nameTeam}}</td>
            <td>
              {{$tebakData = null}}
              @if($match->betMatch->where('idUser', Auth::user()->idUser)->first() != null)
              @php
              $tebakData = $match->betMatch->where('idUser', Auth::user()->idUser)->first();
              @endphp
              {{$tebakData->scorePredHome}} - {{$tebakData->scorePredAway}}
              @else
              Belum ada tebakan
              @endif
            </td>
            <td>
            @if((Carbon\Carbon::parse($match->matchTime))->greaterThan(Carbon\Carbon::now()))
              Belum Dimulai
            @elseif((Carbon\Carbon::parse($match->matchTime)->addMinutes(90))->greaterThan(Carbon\Carbon::now()))
              Sedang berlangsung
            @else
              @if($match->scoreTeamHome == -1 || $match->scoreTeamAway == -1)
                Score Belum di Set
              @else
              {{$match->scoreTeamHome}} - {{$match->scoreTeamAway}}
              @endif
            @endif
            </td>
            <td>{{date( "d-M-Y H:i", strtotime( $match->matchTime ) )}}</td>
            <td>
              @if((Carbon\Carbon::parse($match->matchTime)->addMinutes(90))->greaterThan(Carbon\Carbon::now()) || ($match->scoreTeamHome == -1 || $match->scoreTeamAway == -1))
              <p>-</p>
              @elseif($tebakData != null)
                @if($match->scoreTeamHome == $tebakData->scorePredHome && $match->scoreTeamAway == $tebakData->scorePredAway)
                <p class="font-weight-bold text-success">Tebakan Benar</p>
                @else
                <p class="font-weight-bold text-danger">Tebakan Meleset</p>
                @endif
              @else
              <p class="font-weight-bold text-danger">Lewat</p>
              @endif
            </td>
            <td>
              @if($tebakData == null)
            <a href="tebak/{{$match->idMatch}}/tebak" class="btn btn-sm btn-primary {{ (Carbon\Carbon::parse($match->matchTime))->lessThan(Carbon\Carbon::now()) ? 'disabled' : '' }}">Tebak</a>
              @else
              <a href="tebak/edit/{{$match->idMatch}}" class="btn btn-sm btn-warning {{ (Carbon\Carbon::parse($match->matchTime))->lessThan(Carbon\Carbon::now()) ? 'disabled' : '' }}">Ubah Tebakan</a>
              @endif
          </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- @extends('layouts/foot') -->
@endsection

</html>