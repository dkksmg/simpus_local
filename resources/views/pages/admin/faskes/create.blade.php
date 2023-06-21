@extends('layouts.app')
@push('addon-styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="fs-2 fw-semibold">Tambah Faskes</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.index') }}" class="text-decoration-none">Faskes</a>
                    </li>
                    <li class="breadcrumb-item active"><span>Tambah</span></li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-5 mb-4">
                    <div class="example">
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel">
                                <div class="row">
                                    <div class="col-auto">
                                        <label for="btnGroupAddon2">Cek Data Klinik</label>
                                    </div>
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <input class="form-control" type="text" placeholder="Masukkan Kode Klinik"
                                                name="kode_klinik" id="kode_klinik">
                                            <button id="search" class="btn btn-warning input-group-text" type="button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('faskes.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-10">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Data Akun Faskes</h5>
                            </div>
                            <div class="card-body">
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="email_faskes">Email Faskes</label>
                                                        <input
                                                            class="form-control @error('email_faskes') is-invalid @enderror"
                                                            value="{{ old('email_faskes') }}" id="email_faskes"
                                                            name="email_faskes" type="email">
                                                        @error('email_faskes')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="role_faskes">Role</label>
                                                        <select
                                                            class="form-select @error('role_faskes') is-invalid @enderror"
                                                            name="role_faskes">
                                                            <option value=""></option>
                                                            <option value="KLINIK"
                                                                {{ old('role_faskes') == 'KLINIK' ? 'selected' : '' }}>
                                                                Klinik
                                                            </option>
                                                        </select>
                                                        @error('role_faskes')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="password">Password</label>
                                                        <input class="form-control @error('password') is-invalid @enderror"
                                                            id="password" name="password" type="password">
                                                        @error('password')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="password_confirmation">Password
                                                            Konfirmasi</label>
                                                        <input
                                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                                            id="password_confirmation" name="password_confirmation"
                                                            type="password" onChange="checkPasswordMatch();">
                                                        @error('password_confirmation')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        <p class="text-danger mt-3" id="divCheckPasswordMatch">
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Detail Faskes</h5>
                            </div>
                            <div class="card-body">
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nama_faskes">Nama
                                                            Faskes</label>
                                                        <input
                                                            class="form-control-plaintext @error('nama_faskes') is-invalid @enderror"
                                                            id="nama_faskes" type="text" name="nama_faskes"
                                                            value="{{ old('nama_faskes') }}" readonly>
                                                        @error('nama_faskes')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="pj_faskes">Penanggung Jawab
                                                            Faskes</label>
                                                        <input
                                                            class="form-control-plaintext @error('pj_faskes') is-invalid @enderror"
                                                            value="{{ old('pj_faskes') }}" id="pj_faskes"
                                                            name="pj_faskes" readonly>
                                                        @error('pj_faskes')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="kontak_faskes">Kontak Faskes
                                                        </label>
                                                        <input
                                                            class="form-control-plaintext @error('kontak_faskes') is-invalid @enderror"
                                                            id="kontak_faskes" name="kontak_faskes"
                                                            value="{{ old('kontak_faskes') }}" readonly>
                                                        @error('kontak_faskes')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="exampleFormControlTextarea1">Alamat
                                                            Faskes
                                                        </label>
                                                        <textarea class="form-control-plaintext @error('alamat_faskes') is-invalid @enderror" id="alamat_faskes"
                                                            name="alamat_faskes" readonly style="resize: none">{{ old('alamat_faskes') }}</textarea>
                                                        @error('alamat_faskes')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="exampleFormControlTextarea1">Nomor
                                                            Ijin
                                                        </label>
                                                        <input
                                                            class="form-control-plaintext @error('no_ijin') is-invalid @enderror"
                                                            id="no_ijin" name="no_ijin" readonly
                                                            value="{{ old('no_ijin') }}"></inp>
                                                        @error('no_ijin')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="kontak_pj">Kontak
                                                            PJ
                                                        </label>
                                                        <input
                                                            class="form-control-plaintext @error('kontak_pj') is-invalid @enderror"
                                                            id="kontak_pj" name="kontak_pj" readonly
                                                            value="{{ old('kontak_pj') }}"></inp>
                                                        @error('kontak_pj')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="tgl_terbit">Tanggal Terbit Ijin
                                                        </label>
                                                        <input
                                                            class="form-control-plaintext @error('tgl_terbit') is-invalid @enderror"
                                                            id="tgl_terbit" name="tgl_terbit" readonly
                                                            value="{{ old('tgl_terbit') }}" />
                                                        @error('tgl_terbit')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="tgl_berakhir">Tanggal Berakhir Ijin
                                                        </label>
                                                        <input
                                                            class="form-control-plaintext @error('tgl_berakhir') is-invalid @enderror"
                                                            id="tgl_berakhir" name="tgl_berakhir" readonly
                                                            value="{{ old('tgl_berakhir') }}" />
                                                        @error('tgl_berakhir')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="kecamatan_faskes">Kecamatan
                                                        </label>
                                                        <input
                                                            class="form-control-plaintext @error('kecamatan_faskes') is-invalid @enderror"
                                                            id="kecamatan_faskes" name="kecamatan_faskes" readonly
                                                            value="{{ old('kecamatan_faskes') }}"></inp>
                                                        @error('kecamatan_faskes')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="kelurahan_faskes">Kelurahan
                                                        </label>
                                                        <input
                                                            class="form-control-plaintext @error('kelurahan_faskes') is-invalid @enderror"
                                                            id="kelurahan_faskes" name="kelurahan_faskes" readonly
                                                            value="{{ old('kelurahan_faskes') }}"></inp>
                                                        @error('kelurahan_faskes')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="kode_faskes">Kode Faskes
                                                        </label>
                                                        <input
                                                            class="form-control-plaintext @error('kode_faskes') is-invalid @enderror"
                                                            id="kode_faskes" name="kode_faskes" readonly
                                                            value="{{ old('kode_faskes') }}"></inp>
                                                        @error('kode_faskes')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="kode_faskes">Koordinat Lokasi
                                                        </label>
                                                        <input
                                                            class="form-control-plaintext @error('koordinat_lokasi') is-invalid @enderror"
                                                            id="koordinat_lokasi" name="koordinat_lokasi" readonly
                                                            value="{{ old('koordinat_lokasi') }}"></inp>
                                                        @error('koordinat_lokasi')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="jenis">Jenis Klinik
                                                        </label>
                                                        <input
                                                            class="form-control-plaintext @error('jenis') is-invalid @enderror"
                                                            id="jenis" name="jenis" readonly
                                                            value="{{ old('jenis') }}"></inp>
                                                        @error('jenis')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="pelayanan">Pelayanan Klinik
                                                        </label>
                                                        <input
                                                            class="form-control-plaintext @error('pelayanan') is-invalid @enderror"
                                                            id="pelayanan" name="pelayanan" readonly
                                                            value="{{ old('pelayanan') }}"></inp>
                                                        @error('pelayanan')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-5">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Data</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
@push('addon-scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            // $('.js-example-basic-single').select2({
            //     placeholder: "Pilih",
            //     allowClear: true
            // });
            $("#password, #password_confirmation").keyup(checkPasswordMatch);
        });

        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#password_confirmation").val();
            if ((confirmPassword == "")) {
                $("#divCheckPasswordMatch").html("Password konfirmasi tidak boleh kosong");
            } else {
                if (password != confirmPassword)
                    $("#divCheckPasswordMatch").html("Password konfirmasi tidak sama");
                else
                    $("#divCheckPasswordMatch").html("Password konfirmasi sama").fadeOut(3000);
            }
        }
        $(document).ready(function() {
            $('#search').on('click', function() {
                var value = $('#kode_klinik').val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('admin.faskes.cek') }}',
                    data: {
                        data: value
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('[name=email_faskes]').val(data.data.email_faskes);
                        $('[name=nama_faskes]').val(data.data.nama_faskes);
                        $('[name=pj_faskes]').val(data.data.pj);
                        $('[name=kontak_faskes]').val(data.data.kontak_faskes);
                        $('[name=alamat_faskes]').val(data.data.alamat);
                        $('[name=no_ijin]').val(data.data.ijin_faskes);
                        $('[name=kontak_pj]').val(data.data.kontak_pj);
                        $('[name=kecamatan_faskes]').val(data.data.nama_kecamatan);
                        $('[name=kelurahan_faskes]').val(data.data.nama_kelurahan);
                        $('[name=kode_faskes]').val(data.data.kode_faskes);
                        $('[name=tgl_berakhir]').val(data.data.tgl_berakhir_ijin);
                        $('[name=tgl_terbit]').val(data.data.tgl_terbit_ijin);
                        $('[name=koordinat_lokasi]').val(data.data.koordinat);
                        $('[name=jenis]').val(data.data.jenis);
                        $('[name=pelayanan]').val(data.data.layanan);
                    },
                    error: function() {
                        alert('Data Tidak Ditemukan');
                    }
                });
            })
        });
    </script>
@endpush
