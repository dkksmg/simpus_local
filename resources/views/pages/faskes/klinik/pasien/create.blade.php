@extends('layouts.app')
@push('addon-styles')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="fs-2 fw-semibold">Pendaftaran Pasien Baru</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.dashboard') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.pasien') }}" class="text-decoration-none">Pasien</a>
                    </li>
                    <li class="breadcrumb-item active"><span>Tambah</span></li>
                </ol>
            </nav>
            <form action="{{ route('faskes.pasien.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Data Pasien</h5>
                            </div>
                            <div class="card-body">
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="no_cm">Nomor CM
                                                            </label>
                                                            <input class="form-control @error('no_cm') is-invalid @enderror"
                                                                id="no_cm" type="text" name="no_cm"
                                                                value="{{ old('no_cm') }}">
                                                            @error('no_cm')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nik">NIK
                                                            </label>
                                                            <input class="form-control @error('nik') is-invalid @enderror"
                                                                id="nik" type="text" name="nik"
                                                                value="{{ old('nik') }}" placeholder="NIK">
                                                            @error('nik')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="asuransi_pasien">Asuransi
                                                            </label>
                                                            <select
                                                                class="form-select @error('asuransi_pasien') is-invalid @enderror"
                                                                id="asuransi_pasien" type="text" name="asuransi_pasien">
                                                                <option value="BPJS"
                                                                    {{ old('asuransi_pasien') == 'BPJS' ? 'selected' : '' }}>
                                                                    BPJS</option>
                                                                <option value="-"
                                                                    {{ old('asuransi_pasien') == '-' ? 'selected' : '' }}>
                                                                    Tidak Ada</option>
                                                            </select>

                                                            @error('asuransi_pasien')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="no_asuransi">Nomor Asuransi
                                                            </label>
                                                            <input
                                                                class="form-control @error('no_asuransi') is-invalid @enderror"
                                                                id="no_asuransi" type="text" name="no_asuransi"
                                                                value="{{ old('no_asuransi') }}"
                                                                placeholder="beri tanda strip (-) jika tidak memiliki">
                                                            @error('no_asuransi')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nama_pasien">Nama
                                                            </label>
                                                            <input
                                                                class="form-control @error('nama_pasien') is-invalid @enderror"
                                                                id="nama_pasien" type="text" name="nama_pasien"
                                                                placeholder="Nama Pasien" value="{{ old('nama_pasien') }}">
                                                            @error('nama_pasien')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nama_kk">Kepala Keluarga (KK)
                                                            </label>
                                                            <input
                                                                class="form-control @error('nama_kk') is-invalid @enderror"
                                                                id="nama_kk" type="text" name="nama_kk"
                                                                value="{{ old('nama_kk') }}"
                                                                placeholder="Nama Kepala Keluarga (KK)">
                                                            @error('nama_kk')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="no_kontak">No HP/Telp
                                                            </label>
                                                            <input
                                                                class="form-control @error('no_kontak') is-invalid @enderror"
                                                                id="no_kontak" type="text" name="no_kontak"
                                                                value="{{ old('no_kontak') }}" placeholder="No HP/Telp">
                                                            @error('no_kontak')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="jenis_kelamin">Jenis
                                                                Kelamin</label>
                                                            <select
                                                                class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                                                name="jenis_kelamin">
                                                                <option value=""></option>
                                                                <option value="L"
                                                                    {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                                                    Laki - Laki</option>
                                                                <option value="P"
                                                                    {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                                                    Perempuan</option>
                                                            </select>
                                                            @error('jenis_kelamin')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tmp_lahir">Tempat Lahir
                                                            </label>
                                                            <input
                                                                class="form-control @error('tmp_lahir') is-invalid @enderror"
                                                                id="tmp_lahir" type="text" name="tmp_lahir"
                                                                value="{{ old('tmp_lahir') }}"
                                                                placeholder="Tempat Lahir">
                                                            @error('tmp_lahir')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tgl_lahir">Tanggal Lahir
                                                            </label>
                                                            <input
                                                                class="form-control @error('tgl_lahir') is-invalid @enderror"
                                                                id="tgl_lahir" type="text" name="tgl_lahir"
                                                                value="{{ old('tgl_lahir') }}"
                                                                placeholder="Tanggal Lahir">
                                                            @error('tgl_lahir')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="provinsi_ktp">Provinsi
                                                            </label>
                                                            <select
                                                                class="form-select @error('provinsi_ktp') is-invalid @enderror"
                                                                name="provinsi_ktp">
                                                                <option value=""></option>
                                                                @foreach ($provinsi as $prov)
                                                                    <option value="{{ $prov->id }}"
                                                                        {{ $prov->id == old('provinsi_ktp') ? 'selected' : '' }}>
                                                                        {{ $prov->provinsi }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('provinsi_ktp')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="kotakab_ktp">Kota/Kab
                                                            </label>
                                                            <select
                                                                class="form-select @error('kotakab_ktp') is-invalid @enderror"
                                                                name="kotakab_ktp">
                                                            </select>
                                                            @error('kotakab_ktp')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="kec_ktp">Kecamatan
                                                            </label>
                                                            <select
                                                                class="form-select @error('kec_ktp') is-invalid @enderror"
                                                                name="kec_ktp">
                                                            </select>
                                                            @error('kec_ktp')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="kel_ktp">Kelurahan
                                                            </label>
                                                            <select
                                                                class="form-select @error('kel_ktp') is-invalid @enderror"
                                                                name="kel_ktp">
                                                            </select>
                                                            @error('kel_ktp')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tgl_lahir">Alamat
                                                            </label>
                                                            <textarea class="form-control @error('alamat_ktp') is-invalid @enderror" name="alamat_ktp">{{ old('alamat_ktp') }}</textarea>
                                                            @error('tgl_lahir')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $('#tgl_lahir').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'materialicons',
            showOnFocus: true,
            showRightIcon: false,
            format: 'dd-mm-yyyy'
        });
    </script>
    <script>
        $(document).ready(function() {
            $("[name=provinsi_ktp]")
                .on('change', function() {
                    var prov_id = $(this).find(":selected").val();
                    console.log(prov_id);
                    $("[name=kotakab_ktp]").html('');
                    $.ajax({
                        url: "{{ route('data.kota') }}",
                        type: "POST",
                        data: {
                            prov_id: prov_id,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            $('[name=kotakab_ktp]').html(
                                '<option value="">Pilih Kota/Kab</option>');
                            $.each(result, function(key, value) {
                                $("[name=kotakab_ktp]").append('<option value="' + value
                                    .id + '">' + value.kota + '</option>');
                            });
                            $('[name=kec_ktp]').html('<option value=""></option>');
                            $('[name=kel_ktp]').html('<option value=""></option>');
                        }
                    });
                });
            $('[name=kotakab_ktp]').on('change', function() {
                var kota_id = this.value;
                $("[name=kec_ktp]").html('');
                $.ajax({
                    url: "{{ route('data.kecamatan') }}",
                    type: "POST",
                    data: {
                        kota_id: kota_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('[name=kec_ktp]').html('<option value="">Pilih Kecamatan</option>');
                        $.each(res, function(key, value) {
                            $("[name=kec_ktp]").append('<option value="' + value
                                .id + '">' + value.kecamatan + '</option>');
                        });
                        $('[name=kel_ktp]').html('<option value=""></option>');
                    }
                });
            });
            $('[name=kec_ktp]').on('change', function() {
                var kec_id = this.value;
                $("[name=kel_ktp]").html('');
                $.ajax({
                    url: "{{ route('data.kelurahan') }}",
                    type: "POST",
                    data: {
                        kec_id: kec_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('[name=kel_ktp]').html('<option value="">Pilih Kelurahan</option>');
                        $.each(res, function(key, value) {
                            $("[name=kel_ktp]").append('<option value="' + value
                                .id + '">' + value.kelurahan + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endpush
