@extends('layouts.app')
@push('addon-styles')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    {{-- <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}
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
    <link href="https://coreui.io/demos/bootstrap/4.3/default-v3/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css"
        rel="stylesheet">
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="col-sm-8 mb-2">
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
                        <div class="card-header">
                            <h4>Data Pasien</h4>
                        </div>
                        <div class="card-body mb-0">
                            <div class="example">
                                <div class="tab-content rounded-bottom">
                                    <div class="tab-pane p-3 active preview" role="tabpanel">
                                        <div class="row g-3">
                                            <div class="table-responsive">

                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td>ID Encounter</td>
                                                        <td>:</td>
                                                        <td>{{ $data->id_encounter == null ? '-' : $data->id_encounter }}
                                                        </td>
                                                        <td>No IHS</td>
                                                        <td>:</td>
                                                        <td>{{ $data->no_ihs == null ? '-' : $data->no_ihs }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No CM</td>
                                                        <td>:</td>
                                                        <td>{{ $data->no_cm }}</td>
                                                        <td>NIK</td>
                                                        <td>:</td>
                                                        <td>{{ $data->detail_pasien->nik }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>:</td>
                                                        <td>{{ $data->detail_pasien->nama_pasien }}</td>
                                                        <td>Kepala Keluarga</td>
                                                        <td>:</td>
                                                        <td>{{ $data->detail_pasien->nama_kk }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alamat</td>
                                                        <td>:</td>
                                                        <td>
                                                            <textarea name="" id="" cols="20" rows="5" class="form-control-plaintext"
                                                                style="resize: none" disabled readonly wrap="hard">{{ $data->detail_pasien->alamat . ucwords(strtolower(' Kelurahan ' . $data->detail_pasien->detail_kelurahan->kelurahan . ' Kecamatan ' . $data->detail_pasien->detail_kecamatan->kecamatan . ' ' . $data->detail_pasien->detail_kotakab->kota . ' Provinsi ' . $data->detail_pasien->detail_provinsi->provinsi)) }}</textarea>
                                                        </td>
                                                        <td>TTL</td>
                                                        <td>:</td>
                                                        <td>{{ $data->detail_pasien->tmp_lahir . ', ' . \Carbon\Carbon::parse($data->detail_pasien->tgl_lahir)->translatedFormat('d F Y') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Usia</td>
                                                        <td>:</td>
                                                        <td>{{ $usia }}</td>
                                                        <td>Jenis Kelamin</td>
                                                        <td>:</td>
                                                        <td>{{ $data->detail_pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cara Bayar</td>
                                                        <td>:</td>
                                                        <td>{{ $data->cara_bayar }}</td>
                                                        <td>Nomor Asuransi</td>
                                                        <td>:</td>
                                                        <td>{{ $data->detail_pasien->nomor_asuransi }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Poli</td>
                                                        <td>:</td>
                                                        <td>{{ $data->detail_poli->nama_poli }}</td>
                                                        <td>Tanggal Kunjungan</td>
                                                        <td>:</td>
                                                        <td>{{ \Carbon\Carbon::parse($data->tgl_kunjungan)->format('d-m-Y') . ' Pukul ' . \Carbon\Carbon::parse($data->created_at)->translatedFormat('H:i:s') }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('faskes.catat.store') }}" class="form-inline" method="POST">
                        @csrf
                        {{ Form::hidden('kunjungan', Request::segment(4)) }}
                        {{ Form::hidden('no_cm', $data->no_cm) }}
                        {{ Form::hidden('poli', $data->poli) }}
                        {{ Form::hidden('tgl_kunjungan', $data->tgl_kunjungan) }}
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Pemeriksaan</h4>
                            </div>
                            <div class="card-body mb-0">
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-3">
                                                        <tr>
                                                            <th colspan="2">Anamnesa</th>
                                                            <td>:</td>
                                                            <td colspan="2">
                                                                <textarea rows="3" class="form-control" name="anamnesa">{{ old('anamnesa') }}</textarea>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="3">Pemeriksaan Klinis</th>
                                                        </tr>
                                                        <tr>
                                                            <th rowspan="3" width="30px"></th>
                                                            <td>Kesadaran</td>
                                                            <td>:</td>
                                                            <td>
                                                                <select name="kesadaran" class="form-select">
                                                                    <option></option>
                                                                    @foreach ($kesadaran as $kes)
                                                                        <option value="{{ $kes->kode_kesadaran }}">
                                                                            {{ $kes->nama_kesadaran }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Berat Badan</td>
                                                            <td>:</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" id="beratBadan" name="beratBadan"
                                                                        value="{{ old('beratBadan') }}"
                                                                        class="form-control" onchange="IMT()">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">Kg</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>Tinggi Badan</td>
                                                            <td>:</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" id="tinggiBadan"
                                                                        name="tinggiBadan" value="{{ old('tinggiBadan') }}"
                                                                        class="form-control" onchange="IMT()">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">Cm</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>IMT </td>
                                                            <td>:</td>
                                                            <td>
                                                                <input type="text" id="imt" class="form-control"
                                                                    readonly name="imt" value="{{ old('IMT') }}">
                                                            </td>
                                                            <td>Lingkar Perut</td>
                                                            <td>:</td>
                                                            <td><input type="text" name="lingkarPerut"
                                                                    value="{{ old('lingkarPerut') }}" class="form-control">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="3">Tanda Vital</th>
                                                        </tr>
                                                        <tr>
                                                            <th rowspan="4" width="30px"></th>
                                                            <td>Suhu</td>
                                                            <td>:</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" name="suhu"
                                                                        value="{{ old('suhu') }}" class="form-control">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><sup>o</sup>C</span>
                                                                    </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tekanan Darah</td>
                                                            <td>:</td>
                                                            <td colspan="4" width="">
                                                                <div class="input-group">
                                                                    <input type="text" name="sistole"
                                                                        value="{{ old('sistole') }}" class="form-control"
                                                                        placeholder="sistole"> /
                                                                    <input type="text" name="diastole"
                                                                        value="{{ old('diastole') }}" class="form-control"
                                                                        placeholder="diastole">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">mmHg</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Respiratory Rate</td>
                                                            <td>:</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" name="respRate"
                                                                        value="{{ old('respRate') }}"
                                                                        class="form-control">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">/menit</span>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>Heart Rate</td>
                                                            <td>:</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="text" name="heartRate"
                                                                        value="{{ old('heartRate') }}"
                                                                        class="form-control">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">bpm</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <hr>
                                                    <div class="table-responsive">

                                                        <table class="table table-borderless">
                                                            <tr>
                                                                <th>Pemeriksaan Fisik</th>
                                                                <td>:</td>
                                                                <td>
                                                                    <textarea class="form-control" name="pemeriksaanFisik"><?= isset($cm['pemeriksaanFisik']) ? $cm['pemeriksaanFisik'] : '' ?></textarea>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Diagnosa</th>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <div id="icdRow1">
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" id="icdx1"
                                                                                name="diag1" required
                                                                                value="<?= isset($cm['diag1']) ? $cm['diag1'] : '' ?>"
                                                                                class="form-control"
                                                                                style="max-width: 16%;text-transform: uppercase;"
                                                                                onchange="diagnosaName(this.value,1)"
                                                                                placeholder="ICD-10" />
                                                                            <input type="text" id="penyakit1"
                                                                                value="" class="form-control"
                                                                                readonly placeholder="Display Diagnosa">
                                                                            <div class="input-group-append">
                                                                                <button class="btn btn-outline-primary"
                                                                                    type="button"
                                                                                    onclick="diagnosaDaftar(1)">...</button>
                                                                                <button class="btn btn-outline-warning"
                                                                                    type="button"
                                                                                    onclick="tambahDiagnosa()"
                                                                                    id="btnTambahDiag"
                                                                                    data-diagNext="2">+</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="icdRow2"
                                                                        <?= isset($cm['diag2']) && $cm['diag2'] != '' ? '' : "style='display: none;'" ?>>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" id="icdx2"
                                                                                name="diag2"
                                                                                value="<?= isset($cm['diag2']) ? $cm['diag2'] : '' ?>"
                                                                                class="form-control"
                                                                                style="max-width: 16%;text-transform: uppercase;"
                                                                                onchange="diagnosaName(this.value,2)"
                                                                                placeholder="ICD-10" />
                                                                            <input type="text" id="penyakit2"
                                                                                value="" class="form-control"
                                                                                readonly placeholder="Display Diagnosa">
                                                                            <div class="input-group-append">
                                                                                <button class="btn btn-outline-primary"
                                                                                    type="button"
                                                                                    onclick="diagnosaDaftar(2)">...</button>
                                                                                <button class="btn btn-outline-warning"
                                                                                    type="button"
                                                                                    onclick="hideDiagnosa(2)">
                                                                                    -
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="icdRow3"
                                                                        <?= isset($cm['diag3']) && $cm['diag3'] != '' ? '' : "style='display: none;'" ?>>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" id="icdx3"
                                                                                name="diag3"
                                                                                value="<?= isset($cm['diag3']) ? $cm['diag3'] : '' ?>"
                                                                                class="form-control"
                                                                                style="max-width: 16%;text-transform: uppercase;"
                                                                                onchange="diagnosaName(this.value,3)"
                                                                                placeholder="ICD-10" />
                                                                            <input type="text" id="penyakit3"
                                                                                value="" class="form-control"
                                                                                readonly placeholder="Display Diagnosa">
                                                                            <div class="input-group-append">
                                                                                <button class="btn btn-outline-primary"
                                                                                    type="button"
                                                                                    onclick="diagnosaDaftar(3)">...</button>
                                                                                <button class="btn btn-outline-warning"
                                                                                    type="button"
                                                                                    onclick="hideDiagnosa(3)">
                                                                                    -
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="6">
                                                                    <hr>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Tindakan</th>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <div id="RowTindakan">
                                                                        <div id="RowTindakan1">
                                                                            <div class="input-group mb-3">
                                                                                <input type="text" id="kodeTindakan1"
                                                                                    name="tindakan[]" value=""
                                                                                    class="form-control"
                                                                                    style="max-width: 16%"
                                                                                    placeholder="Kode Tindakan">
                                                                                <input type="text" id="Tindakan1"
                                                                                    value="" class="form-control"
                                                                                    readonly
                                                                                    placeholder="Display Tindakan">
                                                                                <div class="input-group-append">
                                                                                    <button class="btn btn-outline-primary"
                                                                                        type="button"
                                                                                        onclick="tindakanDaftar(1)">...</button>
                                                                                    <button class="btn btn-outline-warning"
                                                                                        id="tambahTindakanId"
                                                                                        type="button"
                                                                                        onclick="tambahTindakan(2)">+</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="6">
                                                                    <hr>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Obat</th>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <div id="RowObat">
                                                                        <div id="RowObat1">
                                                                            <div class="input-group mb-3">
                                                                                <input type="text" name="obat[]"
                                                                                    id="obat1" value=""
                                                                                    class="form-control"
                                                                                    style="max-width: 16%"
                                                                                    placeholder="Kode Obat">
                                                                                <input type="text" value=""
                                                                                    id="namaObat1" class="form-control"
                                                                                    readonly placeholder="Display Obat">
                                                                                <div class="input-group-append">
                                                                                    <button class="btn btn-outline-primary"
                                                                                        type="button"
                                                                                        onclick="obatDaftar(1)">...</button>
                                                                                    <button class="btn btn-outline-warning"
                                                                                        id="tambahObatId" type="button"
                                                                                        onclick="tambahObat(2)">+</button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group mb-3">
                                                                                Dosis :
                                                                                <input type="text" id="dosis1"
                                                                                    name="dosis[]" class="form-control">
                                                                                Jumlah :
                                                                                <input type="text" id="jumlah1"
                                                                                    name="jumlah[]" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="6">
                                                                    <hr>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Edukasi</th>
                                                                <td>:</td>
                                                                <td>
                                                                    <textarea class="form-control" name="edukasi">{{ old('edukasi') }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Klasifikasi Pemeriksaan</th>
                                                                <td>:</td>
                                                                <td>
                                                                    <select name="status_pemeriksaan" class="form-select">
                                                                        <option></option>
                                                                        <option value="amb">Ambulatory</option>
                                                                        <option value="vr">Virtual</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Status Pulang</th>
                                                                <td>:</td>
                                                                <td>
                                                                    <select name="statusPulang" class="form-select">
                                                                        <option></option>
                                                                        @foreach ($status as $st)
                                                                            <option value="{{ $st->kode_status }}"
                                                                                {{ (($st->kode_status == 'planned'
                                                                                            ? 'disabled'
                                                                                            : '' || $st->kode_status == 'arrived')
                                                                                        ? 'disabled'
                                                                                        : '' || $st->kode_status == 'cancelled')
                                                                                    ? 'disabled'
                                                                                    : '' }}>
                                                                                {{ $st->nama_status }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Pemeriksa</th>
                                                                <td>:</td>
                                                                <td>
                                                                    <select name="pemeriksa" class="form-select">
                                                                        <option value=""></option>
                                                                        @foreach ($nakes as $nk)
                                                                            <option value="{{ $nk->kode_nakes }}"
                                                                                {{ $nk->kode_nakes == $data->dokter ? 'selected' : '' }}>
                                                                                {{ $nk->nama_nakes }}</option>
                                                                        @endforeach
                                                                    </select>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-center"><button type="submit"
                                                                        class="btn btn-success">Simpan</button>
                                                                </td>
                                                        </table>
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
        </div>
    </div>
    </div>
    </div>

    </div>
@endsection
@push('addon-scripts')
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://coreui.io/demos/bootstrap/4.3/default-v3/js/datatables.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    {{-- <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script>
        if ($("#beratBadan").val() != '') {
            IMT();
        }
        if ($('#icdx1').val() != '') {
            diagnosaName($('#icdx1').val(), 1);
        }
        if ($('#icdx2').val() != '') {
            diagnosaName($('#icdx2').val(), 2);
        }
        if ($('#icdx3').val() != '') {
            diagnosaName($('#icdx3').val(), 3);
        }
        if ($('#idCm').val()) {
            historyObat($('#noCm').val(), $('#idCm').val());
            historyTindakan($('#noCm').val(), $('#idCm').val());
        }

        function IMT() {
            bb = $("#beratBadan").val();
            tb = $("#tinggiBadan").val();
            tb = tb / 100;
            imt = (bb / (tb * tb)).toFixed(2);
            console.log(imt);
            $("#imt").val(imt);
        }

        function diagnosaName(icd, ke) {
            $.get('{{ route('data.ajax.view-icd') }}', {
                    icd: icd
                },
                function(data) {
                    console.log(data)
                    if (data.status) {
                        $('#penyakit' + ke).val(data.data.diagnosa)
                    } else {
                        $('#penyakit' + ke).val("")
                        $('#icdx' + ke).val("")
                        alert("Kode diagnosa dimasukan salah");
                        $('#icdx' + ke).focus();
                    }
                })
        }

        function diagnosaDaftar(ke) {
            $.get('{{ route('data.ajax.tampil-icd', '') }}' + '/' + ke,
                function(data) {
                    $("#Popup").html(data);
                    // jQuery.noConflict();
                    $("#diagnosaDaftar").modal('show');
                })
        }

        function tambahDiagnosa() {
            ke = $("#btnTambahDiag").attr('data-diagNext');
            if (ke == 2) {
                $("#btnTambahDiag").attr('data-diagNext', '3');
            } else {
                $("#btnTambahDiag").prop('disabled', true);
            }
            $("#icdRow" + ke).show();
        }

        function hideDiagnosa(ke) {
            $("#icdx" + ke).val('');
            $("#penyakit" + ke).val('');
            $("#icdRow" + ke).hide();
            $("#btnTambahDiag").attr('data-diagNext', ke);
            $("#btnTambahDiag").prop('disabled', false);
            if (ke == 3 && $("#icdx2").is(":hidden")) {
                $("#btnTambahDiag").attr('data-diagNext', '2');
            }
        }

        function tindakanDaftar(ke) {
            $.get('{{ route('data.ajax.tampil-tindakan', '') }}' + '/' + ke,
                function(data) {
                    $("#Popup").html(data);
                    // jQuery.noConflict();
                    $("#tindakanDaftar").modal('show');
                })
        }

        function tambahTindakan(ke) {
            next = ke + 1;
            append = '<div id="RowTindakan' + ke + '"><div class="input-group mb-3">' +
                '<input type="text" id="kodeTindakan' + ke +
                '" name="tindakan[]" placeholder="Kode Tindakan" value="" class="form-control" style="max-width: 16%">' +
                '<input type="text" id="Tindakan' + ke +
                '" value="" placeholder="Display Tindakan" class="form-control" readonly>' +
                '<div class="input-group-append">' +
                '<button class="btn btn-outline-primary" type="button" onclick="tindakanDaftar(' + ke +
                ')">...</button>' +
                '<button class="btn btn-outline-warning" type="button" onclick="hapusTindakan(' + ke + ')">-</button>' +
                '</div></div></div>';
            console.log('append' + ke);
            $("#RowTindakan").append(append);
            $("#tambahTindakanId").attr('onclick', 'tambahTindakan(' + next + ')')
        }

        function hapusTindakan(ke) {
            console.log('hapus' + ke);
            $("#RowTindakan" + ke).remove();
        }

        function obatDaftar(ke) {
            $.get('{{ route('data.ajax.tampil-obat', '') }}' + '/' + ke,
                function(data) {
                    $("#Popup").html(data);
                    // jQuery.noConflict();
                    $("#obatDaftar").modal('show');
                })
        }

        function tambahObat(ke) {
            next = ke + 1;
            append = '<div id="RowObat' + ke + '"><div class="input-group mb-3">' +
                '<input type="text" placehoder="Kode Obat" id="obat' + ke +
                '" name="obat[]" value="" class="form-control" style="max-width: 16%">' +
                '<input type="text" placeholder="Display Obat" id="namaObat' + ke +
                '" value="" class="form-control" readonly>' +
                '<div class="input-group-append">' +
                '<button class="btn btn-outline-primary" type="button" onclick="obatDaftar(' + ke + ')">...</button>' +
                '<button class="btn btn-outline-warning" type="button" onclick="hapusObat(' + ke + ')">-</button>' +
                '</div></div><div class="input-group mb-3">' +
                'Dosis : <input type="text" id="dosis' + ke + '" name="dosis[]" class="form-control">' +
                'Jumlah : <input type="text" id="jumlah' + ke + '" name="jumlah[]" class="form-control">' +
                '</div></div>';
            console.log('append' + ke);
            $("#RowObat").append(append);
            $("#tambahObatId").attr('onclick', 'tambahObat(' + next + ')')
        }

        function hapusObat(ke) {
            console.log('hapus' + ke);
            $("#RowObat" + ke).remove();
        }

        function historyObat(noCm, id) {
            $.get(base_url + 'ajax/history/obat', {
                    noCm: noCm,
                    id: id
                },
                function(data) {
                    obat = data.data
                    if (data.status) {
                        for (var i = 0; i < obat.length; i++) {
                            j = i + 1;
                            if (j > 1) {
                                tambahObat(j);
                            }
                            $("#obat" + j).val(obat[i]['obat']);
                            $("#dosis" + j).val(obat[i]['dosis']);
                            $("#jumlah" + j).val(obat[i]['jumlah']);
                            namaObat(obat[i]['obat'], "#namaObat" + j)
                        }
                    } else {
                        console.log('baru');
                    }
                })
        }

        function historyTindakan(noCm, id) {
            $.get(base_url + 'ajax/history/tindakan', {
                    noCm: noCm,
                    id: id
                },
                function(data) {
                    tindakan = data.data
                    if (data.status) {
                        for (var i = 0; i < tindakan.length; i++) {
                            j = i + 1;
                            if (j > 1) {
                                tambahTindakan(j);
                            }
                            $("#kodeTindakan" + j).val(tindakan[i]['tindakan']);
                            namaTindakan(tindakan[i]['tindakan'], "#Tindakan" + j)
                        }
                    } else {
                        console.log('baru');
                    }
                })
        }

        function namaTindakan(tindakan, id) {
            $.get(base_url + "ajax/kamus/tindakan", {
                    tindakan: tindakan
                },
                function(data) {
                    $(id).val(data.data.nmTindakan);
                })
        }

        function namaObat(obat, id) {
            $.get(base_url + "ajax/kamus/obat", {
                    obat: obat
                },
                function(data) {
                    $(id).val(data.data.nmObat);
                })
        }
    </script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}

    {{-- <script src="{{ url('vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script> --}}
@endpush
