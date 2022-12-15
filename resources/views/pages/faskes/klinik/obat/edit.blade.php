@extends('layouts.app')
@push('addon-styles')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    {{-- <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="fs-2 fw-semibold">Edit Data Obat</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.dashboard') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.obat') }}" class="text-decoration-none">Obat</a>
                    </li>
                    <li class="breadcrumb-item active"><span>Edit</span></li>
                </ol>
            </nav>
            <form action="{{ route('faskes.obat.update', Crypt::encrypt($obat->kode_obat)) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Data Obat</h5>
                            </div>
                            <div class="card-body">
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="kode_obat">Kode
                                                                Obat</label>
                                                            <input
                                                                class="form-control-plaintext @error('kode_obat') is-invalid @enderror"
                                                                id="kode_obat" type="text" name="kode_obat" readonly
                                                                value="{{ $obat->kode_obat }}">
                                                            @error('kode_obat')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nama_obat">Nama
                                                                Obat</label>
                                                            <input
                                                                class="form-control @error('nama_obat') is-invalid @enderror"
                                                                id="nama_obat" type="text" name="nama_obat"
                                                                value="{{ $obat->nama_obat }}">
                                                            @error('nama_obat')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="jenis_obat">Jenis Obat
                                                            </label>
                                                            <input
                                                                class="form-control @error('jenis_obat') is-invalid @enderror"
                                                                id="jenis_obat" type="text" name="jenis_obat"
                                                                value="{{ $obat->jenis_obat }}"
                                                                placeholder="Syrup, Suspensi, Tablet, Salep, Puyer dll">
                                                            @error('jenis_obat')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="dosis_obat">Dosis Obat
                                                            </label>
                                                            <input
                                                                class="form-control @error('dosis_obat') is-invalid @enderror"
                                                                id="dosis_obat" type="text" name="dosis_obat"
                                                                value="{{ $obat->dosis_obat }}">
                                                            @error('dosis_obat')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="pabrik_obat">Pabrikan Obat
                                                            </label>
                                                            <input
                                                                class="form-control @error('pabrik_obat') is-invalid @enderror"
                                                                id="pabrik_obat" type="text" name="pabrik_obat"
                                                                value="{{ $obat->pabrik_obat }}">
                                                            @error('pabrik_obat')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tarif_obat">Tarif Obat
                                                            </label>
                                                            <input
                                                                class="form-control @error('tarif_obat') is-invalid @enderror"
                                                                id="tarif_obat" type="number" name="tarif_obat"
                                                                value="{{ $obat->tarif_obat }}" type-currency="IDR">
                                                            @error('tarif_obat')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-5">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Ubah
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
    {{-- <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script> --}}
    {{-- <script type="text/javascript">
        document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
            element.addEventListener('keyup', function(e) {
                let cursorPostion = this.selectionStart;
                let value = parseInt(this.value.replace(/[^,\d]/g, ''));
                let originalLenght = this.value.length;
                if (isNaN(value)) {
                    this.value = "";
                } else {
                    this.value = value.toLocaleString('id-ID', {
                        currency: 'IDR',
                        style: 'currency',
                        minimumFractionDigits: 0
                    });
                    cursorPostion = this.value.length - originalLenght + cursorPostion;
                    this.setSelectionRange(cursorPostion, cursorPostion);
                }
            });
        });
    </script> --}}
@endpush
