@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Register') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

              <div class="col-md-6">
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                @error('username')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>
            </div>

            <div class="form-group row">
              <label for="bank" class="col-md-4 col-form-label text-md-right">{{ __('Nama Bank') }}</label>

              <div class="col-md-6">
                <input id="bank" type="text" class="form-control @error('bank') is-invalid @enderror" name="bank" value="{{ old('bank') }}" required autocomplete="bank" autofocus>

                @error('bank')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="accName" class="col-md-4 col-form-label text-md-right">{{ __('Nama Rekening') }}</label>

              <div class="col-md-6">
                <input id="accName" type="text" class="form-control @error('accName') is-invalid @enderror" name="accName" value="{{ old('accName') }}" required autocomplete="accName" autofocus>

                @error('accName')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="noAcc" class="col-md-4 col-form-label text-md-right">{{ __('No. Rekening') }}</label>

              <div class="col-md-6">
                <input id="noAcc" type="text" class="form-control @error('noAcc') is-invalid @enderror" name="noAcc" value="{{ old('noAcc') }}" required autocomplete="noAcc" autofocus>

                @error('noAcc')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>


            <div class="form-group row">
              <label for="isAdmin" class="col-md-4 col-form-label text-md-right" style="display: none">{{ __('Role') }}</label>

              <div class="col-md-6">
                <select class="form-control" id="isAdmin" name="isAdmin" style="display: none">
                  <option name="isAdmin" value="1">Admin</option>
                  <option name="isAdmin" value="0" default>Member</option>
                </select>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Register') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection