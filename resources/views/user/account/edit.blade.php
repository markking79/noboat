@extends('layouts.app')

@section('page-title') Edit Account @endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Edit Account</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-12 col-md-3 col-form-label text-md-right">Trail Name</label>

                    <div class="col-12 col-md-9">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-12 col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-12 col-md-9">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <input id="dummy-pass" type="password" class="form-control" name="dummy-pass" style="display: none;">
                <div class="form-group row">
                    <label for="password" class="col-12 col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-12 col-md-9">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-12 col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-12 col-md-9">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div><br />

@endsection