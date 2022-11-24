@extends('layouts.auth')
@section('content')
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            <div class="card-body">
                                <h1>Masuk</h1>
                                <p class="text-medium-emphasis">Masuk ke akun SIM E-Klinik</p>
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="input-group mb-3"><span class="input-group-text">
                                            <i class="fa-light fa-user"></i>
                                        </span>
                                        <input class="form-control" @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="Alamat Email">
                                        @error('email')
                                            <div class="alert alert-danger rounded mt-2" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-4"><span class="input-group-text">
                                            <i class="fa-light fa-lock"></i>
                                        </span>
                                        <input class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" placeholder="Password" type="password">
                                        @error('password')
                                            <div class="alert alert-danger rounded mt-2" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                Ingat saya
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-primary px-4" type="submit">Masuk</button>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <div class="col-6 text-end">
                                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                                    Lupa Password
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card col-md-5 text-white bg-primary py-5">
                            <div class="card-body text-center">
                                <div>
                                    <h2>SIM E-Klinik!</h2>
                                    <p>Jika Anda belum memiliki akun silakan Daftar dengan klik button Daftar Sekarang</p>
                                    <a href="{{ route('register') }}" class="btn btn-lg btn-outline-light mt-3">Daftar
                                        Sekarang!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
