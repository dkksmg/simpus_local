@extends('layouts.app')
@push('addon-styles')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    {{-- <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="fs-2 fw-semibold">Tambah Tindakan</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.dashboard') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.tindakan') }}" class="text-decoration-none">Tindakan</a>
                    </li>
                    <li class="breadcrumb-item active"><span>Tambah</span></li>
                </ol>
            </nav>
            <form action="{{ route('faskes.tindakan.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Data Tindakan</h5>
                            </div>
                            <div class="card-body">
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="kode_tindakan">Kode
                                                                Tindakan</label>
                                                            <input
                                                                class="form-control-plaintext @error('kode_tindakan') is-invalid @enderror"
                                                                id="kode_tindakan" type="text" name="kode_tindakan"
                                                                readonly value="{{ $kode_tindakan }}">
                                                            @error('kode_tindakan')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="detail_tindakan">Detail Tindakan
                                                            </label>
                                                            <textarea class="form-control @error('detail_tindakan') is-invalid @enderror" id="detail_tindakan" type="text"
                                                                name="detail_tindakan">{{ old('detail_tindakan') }}</textarea>
                                                            @error('detail_tindakan')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tarif_tindakan">Tarif Tindakan
                                                            </label>
                                                            <input
                                                                class="form-control @error('tarif_tindakan') is-invalid @enderror"
                                                                id="tarif_tindakan" type="number" name="tarif_tindakan"
                                                                value="{{ old('tarif_tindakan') }}" type-currency="IDR">
                                                            @error('tarif_tindakan')
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
