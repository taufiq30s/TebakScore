@extends('layout')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Manage Tebakan</div>
        <div class="card-body">
          @if($edit == 0)
          <form action="{{ route('registTebakan', [$idMatch]) }}" method="post" id="matchForm">
            @else
            <form action="{{ route('ubahTebakan', [$idMatch]) }}" method="post" id="matchForm">
              @endif
              @csrf
              <div class="form-group row">
                <label for="homePredScore" class="col-md-4 col-form-label text-md-right">"{{__('Score Tim Rumah')}}"</label>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-danger btn-number btnHome" data-type="minus" data-field="homePredScore">
                        <i class="fas fa-minus-circle"></i>
                      </button>
                    </span>
                    <input type="text" class="form-control input-number {{ $errors->has('homePredScore') ? ' is-invalid' : '' }}" name="homePredScore" id="homeScore" value="{{ ($edit == 1) ? $data->scorePredHome : 0 }}" required  min="0" max="100">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="homePredScore">
                        <i class="fas fa-plus-circle"></i>
                      </button>
                    </span>
                    @if ($errors->has('homePredScore'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('homePredScore') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="awayPredScore" class="col-md-4 col-form-label text-md-right">{{__('Score Tim Tamu')}}</label>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-danger btn-number btnAway" data-type="minus" data-field="awayPredScore">
                        <i class="fas fa-minus-circle"></i>
                      </button>
                    </span>
                    <input type="text" class="form-control input-number {{ $errors->has('awayPredScore') ? ' is-invalid' : '' }}" name="awayPredScore" id="awayScore" value="{{ ($edit == 1) ? $data->scorePredAway : 0 }}" required value="0" min="0" max="100">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="awayPredScore">
                        <i class="fas fa-plus-circle"></i>
                      </button>
                    </span>
                    @if ($errors->has('awayPredScore'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('awayPredScore') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    @if($edit == 0)
                    {{ __('Simpan') }}
                    @else
                    {{ __('Edit') }}
                    @endif
                  </button>
                  <a href="{{ url()->route('tebak') }}" class="btn btn-danger">Kembali</a>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection