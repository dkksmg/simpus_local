@extends('layouts.app')
@push('addon-styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <style>
        #penyakitPrim,
        #penyakitSek,
        #penyakitSekDinamis,
        #previewObatPrim,
        #previewObatSek,
        .previewObat,
        #previewRacikanObatPrim,
        .previewRacikanObat {
            background: #dddddd;
            pointer-events: none;
            resize: none;
        }

        hr.pemisah {
            border-top: 2px solid black
        }
    </style>
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="col-sm-8">
                <div class="fs-2 fw-semibold">Pemeriksaan Pasien
                    <p class="badge bg-primary-gradient">{{ $data->detail_pasien->nama_pasien }}</p>
                </div>
                <div class="fw-normal ">
                    {{-- <p class="badge bg-danger-gradient fs-6">
                        {{ $data->detail_poli->nama_poli . ' ' . $data->detail_poli->nama_faskes }} |
                        Waktu mulai
                        {{ \Carbon\Carbon::parse($data->start)->translatedformat('l d F Y H:i:s') }}</p> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body mb-0">
                            <div class="example">
                                <div class="tab-content rounded-bottom">
                                    <div class="tab-pane p-3 active preview" role="tabpanel">
                                        <div class="row g-3">
                                            <label for="" class="fw-bold mb-2 fs-5">Data Pasien</label>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="nama">Nama
                                                        Pasien</label>
                                                    <input class="form-control-plaintext " id="nama" type="text"
                                                        placeholder="" name="nama_pasien"
                                                        value="{{ $data->detail_pasien->nama_pasien }}" readonly disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="ihs">ID IHS Pasien</label>
                                                    <input class="form-control-plaintext"
                                                        value="{{ $data->no_ihs == null ? '-' : $data->no_ihs }}"
                                                        id="ihs" name="id_ihs" readonly disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="nik">NIK</label>
                                                    <input class="form-control-plaintext"
                                                        value="{{ $data->detail_pasien->nik == null ? '-' : $data->detail_pasien->nik }}"
                                                        id="nik" name="nik" readonly disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="ihs">No CM</label>
                                                    <input class="form-control-plaintext" value="{{ $data->no_cm }}"
                                                        id="ihs" name="no_cm" readonly disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Tempat Tanggal Lahir</label>
                                                    <input class="form-control-plaintext"
                                                        value="{{ $data->detail_pasien->tmp_lahir . ', ' . \Carbon\Carbon::parse($data->detail_pasien->tgl_lahir)->translatedFormat('d F Y') }}"
                                                        readonly disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Usia</label>
                                                    <input class="form-control-plaintext" value="{{ $usia }}"
                                                        readonly disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Jenis Kelamin</label>
                                                    <input class="form-control-plaintext"
                                                        value="{{ $data->detail_pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}"
                                                        readonly disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">ID Encounter</label>
                                                    <textarea class="form-control-plaintext" readonly disabled style="resize: none">{{ $data->id_encounter == null ? '-' : $data->id_encounter }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Cara Bayar</label>
                                                    <input class="form-control-plaintext" value="{{ $data->cara_bayar }}"
                                                        readonly disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Nomor Asuransi</label>
                                                    <input class="form-control-plaintext"
                                                        value="{{ $data->detail_pasien->no_asuransi == null ? '-' : $data->detail_pasien->no_asuransi }}"
                                                        readonly disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Poli</label>
                                                    <input class="form-control-plaintext"
                                                        value="{{ $data->detail_poli->nama_poli }}" readonly disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Tanggal Kunjungan</label>
                                                    <input class="form-control-plaintext"
                                                        value="{{ \Carbon\Carbon::parse($data->tgl_kunjungan)->format('d-m-Y') }}"
                                                        readonly disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body mb-0">
                            <div class="example">
                                <div class="tab-content rounded-bottom">
                                    <div class="tab-pane p-3 active preview" role="tabpanel">
                                        <form class="row g-3" action="{{ route('faskes.catat.store') }}" method="POST">
                                            @csrf
                                            {{-- {{ Form::hidden('id', $data->id) }}
                                            {{ Form::hidden('poli', $data->poli) }}
                                            {{ Form::hidden('no_cm', $data->no_cm) }} --}}
                                            <div class="col-md-12">
                                                <div class="card-header">
                                                    <h5><strong>Pemeriksa</strong></h5>
                                                </div>
                                                <div class="card-body mb-0">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="">Status Pasien
                                                                </label>
                                                                <select
                                                                    class="form-select @error('status_pasien') is-invalid @enderror"
                                                                    id="status_pasien" name="status_pasien" autofocus>
                                                                    <option value=""></option>
                                                                    <option value="triaged" disabled
                                                                        {{ old('status_pasien') == 'triaged' ? 'selected' : '' }}>
                                                                        Triase
                                                                    </option>
                                                                    <option value="in-progress" selected
                                                                        {{ old('status_pasien') == 'in-progress' ? 'selected' : '' }}>
                                                                        Sedang
                                                                        berlangsung</option>
                                                                    <option value="onleave" disabled>Sedang pergi</option>
                                                                    <option value="finished" disabled>Sudah selesai
                                                                    </option>
                                                                </select>
                                                                @error('status_pasien')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="">Klasifikasi
                                                                    Pemeriksaan
                                                                </label>
                                                                <select
                                                                    class="form-select @error('pertemuan') is-invalid @enderror"
                                                                    id="pertemuan" name="pertemuan" autofocus>
                                                                    <option value="amb"
                                                                        {{ old('pertemuan') == 'amb' ? 'selected' : '' }}>
                                                                        Ambulatory
                                                                    </option>
                                                                    <option value="vr"
                                                                        {{ old('pertemuan') == 'vr' ? 'selected' : '' }}>
                                                                        Virtual
                                                                    </option>
                                                                </select>
                                                                @error('pertemuan')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="">Dokter
                                                                </label>
                                                                <select
                                                                    class="form-select @error('dokter') is-invalid @enderror"
                                                                    id="dokter" name="dokter">
                                                                    <option value=""> - Pilih - </option>
                                                                    @foreach ($nakes as $nks)
                                                                        <option value="{{ $nks->kode_nakes }}"
                                                                            {{ (old('dokter') == $nks->kode_nakes ? 'selected' : '' || $data->dokter == $nks->kode_nakes) ? 'selected' : '' }}>
                                                                            {{ $nks->nama_nakes }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('pertemuan')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="my-4 pemisah">
                                            <div class="col-md-12">
                                                <div class="card-header">
                                                    <h5><strong>Pemeriksaan</strong></h5>
                                                </div>
                                                <div class="card-body mb-0">
                                                    {{-- <div class="row">
                                                        <div class="col-md-1">
                                                            <label class="form-label" for="">Kesadaran Pasien
                                                            </label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <select
                                                                    class="form-select @error('kesadaran_pasien') is-invalid @enderror"
                                                                    id="kesadaran_pasien" name="kesadaran_pasien"
                                                                    autofocus>
                                                                    <option value=""></option>
                                                                    <option value="1"
                                                                        {{ old('kesadaran_pasien') == 1 ? 'selected' : '' }}>
                                                                        Compos Mentis</option>
                                                                    <option value="2"
                                                                        {{ old('kesadaran_pasien') == 2 ? 'selected' : '' }}>
                                                                        Somnolence</option>
                                                                    <option value="3"
                                                                        {{ old('kesadaran_pasien') == 3 ? 'selected' : '' }}>
                                                                        Sopor
                                                                    </option>
                                                                    <option value="4"
                                                                        {{ old('kesadaran_pasien') == 4 ? 'selected' : '' }}>
                                                                        Coma
                                                                    </option>
                                                                </select>
                                                                @error('kesadaran_pasien')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label class="form-label" for="">Suhu
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="mb-3">
                                                                <input
                                                                    class="form-control @error('suhu_pasien') is-invalid @enderror"
                                                                    id="suhu_pasien" name="suhu_pasien" autofocus
                                                                    value="{{ old('suhu_pasien') }}" type="text" />
                                                                @error('suhu_pasien')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label class="form-label" for="respiratory_pasien">Respiratory
                                                                Rate
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="mb-3">

                                                                <input type="text" name="respiratory_pasien"
                                                                    id="respiratory_pasien" class="form-control"
                                                                    value="{{ old('respiratory_pasien') }}">
                                                                @error('respiratory_pasien')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label class="form-label" for="">Heart Rate
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="mb-3">
                                                                <input
                                                                    class="form-control @error('heart_pasien') is-invalid @enderror"
                                                                    id="heart_pasien" name="heart_pasien" autofocus
                                                                    value="{{ old('heart_pasien') }}" type="text" />
                                                                @error('heart_pasien')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-auto">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <label class="form-label" for="">BB/TB
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="mb-3">
                                                                    <input
                                                                        class="form-control @error('bb_pasien') is-invalid @enderror"
                                                                        id="bb_pasien" name="bb_pasien" autofocus
                                                                        type="text" value="{{ old('bb_pasien') }}" />
                                                                    @error('bb_pasien')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <span>/</span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="mb-3">
                                                                    <input
                                                                        class="form-control @error('tb_pasien') is-invalid @enderror"
                                                                        id="tb_pasien" name="tb_pasien" autofocus
                                                                        type="text" value="{{ old('tb_pasien') }}" />
                                                                    @error('tb_pasien')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-auto ml-2">
                                                                <label class="form-label" for="">Tekanan Darah
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="mb-3">
                                                                    <input
                                                                        class="form-control @error('sis_pasien') is-invalid @enderror"
                                                                        id="sis_pasien" name="sis_pasien" autofocus
                                                                        type="text" placeholder="Sistolik"
                                                                        value="{{ old('sis_pasien') }}" />
                                                                    @error('sis_pasien')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <span>/</span>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="mb-3">
                                                                    <input
                                                                        class="form-control @error('dias_pasien') is-invalid @enderror"
                                                                        id="dias_pasien" name="dias_pasien" autofocus
                                                                        type="text" placeholder="Diastolik"
                                                                        value="{{ old('dias_pasien') }}" />
                                                                    @error('dias_pasien')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="form-label" for="lingkar_pasien">Lingkar
                                                                    Perut
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="mb-3">
                                                                    <input type="text" name="lingkar_pasien"
                                                                        id="lingkar_pasien" class="form-control"
                                                                        value="{{ old('lingkar_pasien') }}">
                                                                    @error('lingkar_pasien')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="fisik_pasien">Pemeriksaan
                                                                    Fisik
                                                                </label>
                                                                <textarea name="fisik_pasien" id="fisik_pasien" class="form-control">{{ old('fisik_pasien') }}</textarea>
                                                                @error('fisik_pasien')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="exampleFormControlTextarea1">Anamnesa
                                                                    Pasien</label>
                                                                <textarea class="form-control @error('anamnesa') is-invalid @enderror" id="exampleFormControlTextarea1"
                                                                    name="anamnesa">{{ old('anamnesa') }}</textarea>
                                                                @error('anamnesa')
                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <hr class="my-4 pemisah">
                                            <div class="col-md-12">
                                                <div class="card-header">
                                                    <h5><strong>Diagnosa</strong></h5>
                                                </div>
                                                <div class="card-body mb-0">
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-left">
                                                            <span for="form-label"
                                                                class="form-label fs-6 fw-semibold">Diagnosa
                                                                Primer</span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <label class="form-label"><a href="javascript:void(0)"
                                                                        class="text-decoration-none"
                                                                        onclick="ListDiagnosa()">
                                                                        ICD-10
                                                                    </a>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mb-3">
                                                                    <input
                                                                        class="form-control @error('diagPrim') is-invalid @enderror"
                                                                        id="diagnosa" name="diagPrim"
                                                                        value="{{ old('diagPrim') }}"
                                                                        placeholder="Kode ICD-10" />
                                                                    @error('diagPrim')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <textarea class="form-control" id="penyakitPrim" name="penyakitPrim" value="{{ old('penyakitPrim') }}"
                                                                        placeholder="Display ICD-10" readonly onchange="textAreaAdjust(this)"></textarea>
                                                                    @error('penyakitPrim')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span>Status</span>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mb-3">
                                                                    <select name="opsiPrim" id="opsiPrim"
                                                                        class="form-select">
                                                                        <option value=""> </option>
                                                                        <option value="baru"> Baru</option>
                                                                        <option value="lama"> Lama</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" id="main-dinamis">
                                                        <div class="d-flex justify-content-left">
                                                            <span for="form-label"
                                                                class="form-label fs-6 fw-semibold">Diagnosa
                                                                Sekunder</span>
                                                        </div>
                                                        <div class="row after-add-more">
                                                            <div class="col-md-1">
                                                                <label class="form-label" for="icd""><a
                                                                        href="javascript:void(0)"
                                                                        class="text-decoration-none"
                                                                        onclick="ListDiagnosa()">
                                                                        ICD-10
                                                                    </a>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mb-3">
                                                                    <input
                                                                        class="form-control @error('diagSek') is-invalid @enderror"
                                                                        id="diagSek" name="diagSek[]"
                                                                        placeholder="Kode ICD-10" />
                                                                    @error('diagSek')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <textarea class="form-control" id="penyakitSek" name="penyakitSek[]" placeholder="Display ICD-10" readonly
                                                                        onchange="textAreaAdjust(this)"></textarea>
                                                                    @error('penyakitSek')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <span>Status</span>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mb-3">
                                                                    <select name="opsiSek[]" id="opsiSek"
                                                                        class="form-select">
                                                                        <option value=""></option>
                                                                        <option value="baru"> Baru</option>
                                                                        <option value="lama"> Lama</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button" class="btn btn-sm btn-success"
                                                                    id="actDiagnosa">Tambah</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="copy invisible">
                                                        <div class="col-md-12 control-group">
                                                            <div class="row">
                                                                <div class="col-md-1">
                                                                    <label class="form-label" for="icd">
                                                                        <a href="javascript:void(0)"
                                                                            class="text-decoration-none"
                                                                            onclick="ListDiagnosa()">
                                                                            ICD-10
                                                                        </a>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="mb-3">
                                                                        <input
                                                                            class="form-control @error('diagSek') is-invalid @enderror"
                                                                            id="diagSekDinamis" name="diagSek[]"
                                                                            placeholder="Kode ICD-10" />
                                                                        @error('diagSek')
                                                                            <div class="alert alert-danger">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                        <textarea class="form-control" id="penyakitSekDinamis" name="penyakitSek[]" placeholder="Display ICD-10" readonly
                                                                            onchange="textAreaAdjust(this)"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <span>Status</span>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="mb-3">
                                                                        <select name="opsiSek[]" id="opsiSek"
                                                                            class="form-select">
                                                                            <option value=""></option>
                                                                            <option value="baru"> Baru</option>
                                                                            <option value="lama"> Lama</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="button" class="btn btn-sm btn-danger"
                                                                        id="removeDiagnosa">Hapus</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="my-4 pemisah">
                                            <div class="col-md-12">
                                                <h5 class="card-title"><strong>Obat</strong></h5>
                                                <div class="card-header">
                                                    <h6><strong>Resep Obat</strong></h6>
                                                </div>
                                                <div class="card-body mb-0">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless" id="dynamic_field">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="0.5%"></th>
                                                                        <th width="3%" class="text-center">Kode Obat
                                                                        </th>
                                                                        <th width="3%" class="text-center">Nama Obat
                                                                        </th>
                                                                        <th width="1%" class="text-center">Jumlah</th>
                                                                        <th width="1%" class="text-center">Dosis</th>
                                                                        <th width="0.5%"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <label class="form-label"><a
                                                                                    href="javascript:void(0)"
                                                                                    class="text-decoration-none"
                                                                                    onclick="ListObat()">
                                                                                    Data Obat
                                                                                </a>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control" id="kodeObatPrim"
                                                                                name="kodeObat[]"
                                                                                placeholder="Kode Obat" />
                                                                        </td>
                                                                        <td>
                                                                            <textarea class="form-control" id="previewObatPrim" name="previewObat[]"readonly onchange="textAreaAdjust(this)"></textarea>
                                                                        </td>
                                                                        <td>

                                                                            <input class="form-control" id="jumlahObat"
                                                                                name="jumlahObat[]" />
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control" id="dosisObat"
                                                                                name="dosisObat[]" />
                                                                        </td>
                                                                        <td style="width=0.5%"><button type="button"
                                                                                class="btn btn-sm btn-success"
                                                                                id="add">Tambah</button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-header">
                                                    <h6><strong>Racikan Obat</strong></h6>
                                                </div>
                                                <div class="card-body mb-0">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-borderless" id="dynamic_field_two">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="0.5%"></th>
                                                                        <th width="3%" class="text-center">Kode
                                                                            Obat
                                                                        </th>
                                                                        <th width="3%" class="text-center">Nama
                                                                            Obat
                                                                        </th>
                                                                        <th width="1%" class="text-center">Jumlah
                                                                        </th>
                                                                        <th width="1%" class="text-center">Dosis
                                                                        </th>
                                                                        <th width="0.5%"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <label class="form-label"><a
                                                                                    href="javascript:void(0)"
                                                                                    class="text-decoration-none"
                                                                                    onclick="ListObat()">
                                                                                    Data Obat
                                                                                </a>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control"
                                                                                id="kodeRacikanObatPrim"
                                                                                name="kodeRacikanObat[]"
                                                                                placeholder="Kode Obat" />
                                                                        </td>
                                                                        <td>
                                                                            <textarea class="form-control" id="previewRacikanObatPrim" name="previewRacikanObat[]" readonly
                                                                                onchange="textAreaAdjust(this)"></textarea>
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control"
                                                                                id="jumlahRacikanObat"
                                                                                name="jumlahRacikanObat[]" />
                                                                        </td>
                                                                        <td>
                                                                            <input class="form-control"
                                                                                id="dosisRacikanObat"
                                                                                name="dosisRacikanObat[]" />
                                                                        </td>
                                                                        <td style="width=0.5%"><button type="button"
                                                                                class="btn btn-sm btn-success"
                                                                                id="add-two">Tambah</button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="row justify-content-md-center">
                                                            <div class="col-md-6">
                                                                <label for="keteranganRacikanObat">Keterangan</label>
                                                                <textarea name="keteranganRacikanObat" id="keteranganRacikanObat" class="form-control" cols="10"
                                                                    rows="5"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4 pemisah">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <h5><strong>Edukasi</strong></h5>
                                </div>
                                <div class="card-body mb-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="edukasi">Edukasi
                                                    Pasien
                                                </label>
                                                <textarea name="edukasi" id="edukasi" class="form-control" onchange="textAreaAdjust(this)" cols="30"
                                                    rows="10">{{ old('edukasi') }}</textarea>
                                                @error('edukasi')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 mt-5 mb-5">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Simpan
                                        Data</button>
                                </div>
                            </div>
                            </form>
                        </div>
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kodeObatPrim').on('change', function() {
                var kode = $(this).val();
                if (kode != "")
                    $.ajax({
                        processing: true,
                        serverSide: true,
                        url: '',
                        type: 'get',
                        data: {
                            kode: kode,
                        },
                        dataType: 'json',
                        success: function(response) {
                            $('#previewObatPrim').val(response.obat);
                        },
                        error: function() {
                            alert('Obat Tidak Ditemukan');
                        }
                    });
                else {
                    $('#obatPrim').val('');
                }
            });
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i +
                    '" class="dynamic-added"><td><label class="form-label"><a href="javascript:void(0)" class="text-decoration-none" onclick="ListObat()"> Data Obat </a></label></td><td><input class = "form-control" id = "kodeObatSek' +
                    i +
                    '" name = "kodeObat[]" placeholder = "Kode Obat" required/></td><td><textarea class = "form-control previewObat" id = "previewObatSek' +
                    i +
                    '" name = "previewObat[]" readonly onchange = "textAreaAdjust(this)" required></textarea></td><td><input class = "form-control" id = "jumlahObat" name = "jumlahObat[]"/ ></td><td><input class = "form-control"id = "dosisObat"name = "dosisObat[]"/ ></td><td><button type="button" name="remove" id="' +
                    i + '" class="btn btn-danger btn-sm btn_remove">Hapus</button></td></tr>');
                var a = i;
                $("body").on("change", '#kodeObatSek' + a + '', function() {
                    var kode = $(this).val();
                    $.ajax({
                        processing: true,
                        serverSide: true,
                        url: '',
                        type: 'get',
                        data: {
                            kode: kode,
                        },
                        dataType: 'json',
                        success: function(response) {
                            $('#previewObatSek' + a + '').val(response.obat);
                        },
                        error: function() {
                            alert('Obat Tidak Ditemukan');
                        }
                    });
                });
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#kodeRacikanObatPrim').on('change', function() {
                var kode = $(this).val();
                console.log(kode);
                if (kode != "")
                    $.ajax({
                        processing: true,
                        serverSide: true,
                        url: '',
                        type: 'get',
                        data: {
                            kode: kode,
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            $('#previewRacikanObatPrim').val(response.obat);
                        },
                        error: function() {
                            alert('Obat Tidak Ditemukan');
                        }
                    });
                else {
                    $('#obatPrim').val('');
                }
            });
            var i = 1;
            $('#add-two').click(function() {
                i++;
                $('#dynamic_field_two').append('<tr id="row' + i +
                    '" class="dynamic-added"><td><label class="form-label"><a href="javascript:void(0)" class="text-decoration-none" onclick="ListObat()"> Data Obat </a></label></td><td><input class = "form-control" id = "kodeRacikanObatSek' +
                    i +
                    '" name = "kodeRacikanObat[]" placeholder = "Kode Obat" required/></td><td><textarea class = "form-control previewRacikanObat" id = "previewRacikanObatSek' +
                    i +
                    '" name = "previewRacikanObat[]" readonly onchange = "textAreaAdjust(this)" required></textarea></td><td><input class = "form-control" id = "jumlahRacikanObatSek" name = "jumlahRacikanObat[]"/ ></td><td><input class = "form-control"id = "dosisRacikanObatSek"name = "dosisRacikanObat[]"/ ></td><td><button type="button" name="remove" id="' +
                    i + '" class="btn btn-danger btn-sm btn_remove_two">Hapus</button></td></tr>');
                var a = i;
                $("body").on("change", '#kodeRacikanObatSek' + a + '', function() {
                    var kode = $(this).val();
                    $.ajax({
                        processing: true,
                        serverSide: true,
                        url: '',
                        type: 'get',
                        data: {
                            kode: kode,
                        },
                        dataType: 'json',
                        success: function(response) {
                            $('#previewRacikanObatSek' + a + '').val(response.obat);
                        },
                        error: function() {
                            alert('Obat Tidak Ditemukan');
                        }
                    });
                });
            });
            $(document).on('click', '.btn_remove_two', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
            $('.js-example-basic-single').select2();

        });
    </script>
    <script type='text/javascript'>
        // Fungsi Diagnosa
        function ListDiagnosa() {
            var myWindow = window.open("", "Tindakan", "width=600,height=500");
            myWindow.focus();
        }

        function ListObat() {
            var myWindow = window.open("", "Tindakan", "width=600,height=500");
            myWindow.focus();
        }
        $(document).ready(function() {
            $("#actDiagnosa").click(function() {
                var html = $(".copy").html();
                $("#main-dinamis").after(html);
            });
            $("body").on("change", "#diagSekDinamis", function() {
                var kode = $(this).val();
                $.ajax({
                    processing: true,
                    serverSide: true,
                    url: '',
                    type: 'get',
                    data: {
                        kode: kode,
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#penyakitSekDinamis').val(response.diagnosa);
                    },
                    error: function() {
                        alert('Diagnosa Tidak Ditemukan');
                    }
                });

            });
            $("body").on("click", "#removeDiagnosa", function() {
                $(this).parents(".control-group").remove();
            });
        });

        function textAreaAdjust(element) {
            element.style.height = "1px";
            element.style.height = (25 + element.scrollHeight) + "px";
        }
        $('#diagnosa').on('change', function() {
            var kode = $(this).val();
            if (kode != "")
                $.ajax({
                    processing: true,
                    serverSide: true,
                    url: '',
                    type: 'get',
                    data: {
                        kode: kode,
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#penyakitPrim').val(response.diagnosa);
                    },
                    error: function() {
                        alert('Diagnosa Tidak Ditemukan');
                    }
                });
            else {
                $('#penyakitPrim').val('');
            }
        });
        $('#diagSek').on('change', function() {
            var kode = $(this).val();
            $.ajax({
                processing: true,
                serverSide: true,
                url: '',
                type: 'get',
                data: {
                    kode: kode,
                },
                dataType: 'json',
                success: function(response) {
                    $('#penyakitSek').val(response.diagnosa);
                },
                error: function() {
                    alert('Diagnosa Tidak Ditemukan');
                }
            });
        });
    </script>
@endpush
