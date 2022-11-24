@extends('layouts.auth')
@section('content')
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card mb-4 mx-4">
                        <div class="card-header">
                            <h1>{{ __('Reset Password') }}</h1>
                        </div>
                        <div class="card-body p-4">

                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="input-group mb-3"><span class="input-group-text">
                                        <i class="fa-light fa-envelope-open"></i>
                                    </span>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <div class="alert alert-danger invalid-feedback rounded mt-2" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <i class="fa-light fa-lock"></i>
                                    </span>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="Password">

                                    @error('password')
                                        <div class="alert alert-danger invalid-feedback rounded mt-2" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="input-group mb-4"><span class="input-group-text">
                                        <i class="fa-light fa-lock"></i>
                                    </span>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Password Konfirmasi">
                                </div>
                                <button class="btn btn-block btn-success" type="submit">{{ __('Reset Password') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
