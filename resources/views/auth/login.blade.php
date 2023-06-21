@extends('layouts.auth')
@push('addon-styles')
    <style type="text/css">
        .login-bg {
            height: 100%;
            width: 100%;
            position: absolute;
            background-image: url('http://119.2.50.170:9095/sim-klinik/asset/img/bg-tugumuda2.jpg');
            opacity: 0.8;
            background-repeat: no-repeat;
            background-size: 100%;
        }

        #back {
            background-color: white;
            position: relative;
            opacity: 1;
        }
    </style>
@endpush
@section('content')
    <div class="login-bg"></div>
    <div class="bg-transparent min-vh-100 d-flex flex-row align-items-center" id="back">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0" style="opacity:1" id="step1">
                            <div class="card-body">
                                <h1>Masuk</h1>
                                <p class="text-medium-emphasis">Masukkan kode klinik Anda</p>

                                <div class="input-group mb-3"><span class="input-group-text">
                                        <i class="fa-light fa-user"></i>
                                    </span>
                                    <input class="form-control" name="kode" required autocomplete="text" autofocus
                                        placeholder="Kode Klinik">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4" type="button" id="search">Periksa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card col-md-7 p-4 mb-0" style="display:none" id="step2">
                            <div class="card-body">
                                <h1 id="nama_klinik"></h1>
                                <p class="text-medium-emphasis">Masukkan username dan password</p>
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    {{-- <div class="input-group mb-3"><span class="input-group-text">
                                            <i class="fa-light fa-user"></i>
                                        </span>
                                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="Alamat Email">
                                        @error('email')
                                            <div class="alert alert-danger rounded mt-2" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div> --}}
                                    <div class="input-group mb-3"><span class="input-group-text">
                                            <i class="fa-light fa-user"></i>
                                        </span>
                                        <input class="form-control @error('username') is-invalid @enderror" name="username"
                                            value="{{ old('username') }}" required autocomplete="username" autofocus
                                            placeholder="Username">
                                        @error('username')
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
                                        <div class="col-3">
                                            <button class="btn btn-primary px-4" type="submit">Masuk</button>
                                        </div>
                                        <div class="col-3 mr-2">
                                            <button class="btn btn-warning px-4"
                                                onclick="window.location.href='{{ route('login') }}'"
                                                type="button">Reset</button>
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
                        <div class="card col-md-5 text-white bg-primary py-3" style="opacity:1">
                            <div class="card-body text-center opacity-100">
                                <div>
                                    <h2>SIM E-Klinik</h2>
                                    <h6>Dinas Kesehatan Kota Semarang</h6>
                                    <img src="{{ url('assets/img/pemkot.png') }}" alt="logo pemkot" class=" img-fluid mt-4"
                                        width="150" height="150">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('addon-scripts')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ url('css/sweetalert2.min.css') }}">
    <script>
        $('#search').on('click', function() {
            var klinik = $('[name=kode]').val();
            console.log(klinik)
            if (klinik == '') {
                Swal.fire({
                    type: 'warning',
                    icon: 'warning',
                    title: 'Kode Klinik tidak boleh kosong',
                    showConfirmButton: false,
                    timer: 6000
                })
            } else {
                $.ajax({
                    type: 'get',
                    url: '{{ route('cek-kode') }}',
                    data: {
                        kode: klinik
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == "active") {
                            $("#nama_klinik").html(data.nama_klinik);
                            $("#step1").slideUp("slow", function() {
                                $("#step2").slideDown('fast');
                            });
                        } else if (data.status == "inactive") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Klinik Tidak Aktif!',
                                showConfirmButton: false,
                                timer: 10000
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Kode Klinik Tidak Terdaftar!',
                                showConfirmButton: false,
                                timer: 10000
                            })
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Kode Klinik Tidak Terdaftar!',
                            showConfirmButton: false,
                            timer: 10000
                        })
                    }
                })
            }
        })
    </script>
@endpush
