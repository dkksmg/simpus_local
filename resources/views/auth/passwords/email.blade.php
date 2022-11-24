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
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <i class="fa-light fa-envelope-open"></i>
                                    </span>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ empty(Auth::user()->email) ? old('email') : Auth::user()->email }}"
                                        required autocomplete="email" placeholder="Alamat Email">
                                    @error('email')
                                        <div class="alert alert-danger invalid-feedback rounded mt-2" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <button class="btn btn-block btn-success" type="submit">Kirim Email Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
