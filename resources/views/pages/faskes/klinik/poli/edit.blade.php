@extends('layouts.app')
@push('addon-styles')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    {{-- <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="fs-2 fw-semibold">Tambah Nakes</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.dashboard') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.nakes') }}" class="text-decoration-none">Nakes</a>
                    </li>
                    <li class="breadcrumb-item active"><span>Tambah</span></li>
                </ol>
            </nav>
            <form action="{{ route('faskes.poli.update', Crypt::encrypt($poli->kode_poli)) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>Data Nakes</h5>
                            </div>
                            <div class="card-body">
                                <div class="example">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel">
                                            <div class="row g-3">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="kode_nakes">Kode
                                                                Poli</label>
                                                            <input
                                                                class="form-control-plaintext @error('kode_poli') is-invalid @enderror"
                                                                id="kode_poli" type="text" name="kode_poli" readonly
                                                                value="{{ $poli->kode_poli }}">
                                                            @error('kode_poli')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nama_poli">Nama
                                                                Poli</label>
                                                            <input
                                                                class="form-control @error('nama_poli') is-invalid @enderror"
                                                                id="nama_poli" type="text" name="nama_poli"
                                                                value="{{ $poli->nama_poli }}">
                                                            @error('nama_poli')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="status_poli">Nama
                                                                Poli</label>
                                                            <select
                                                                class="form-select @error('status_poli') is-invalid @enderror"
                                                                id="status_poli" name="status_poli">
                                                                <option value=""></option>
                                                                <option value="active"
                                                                    {{ $poli->status == 'active' ? 'selected' : '' }}>
                                                                    Aktif</option>
                                                                <option value="inactive"
                                                                    {{ $poli->status == 'inactive' ? 'selected' : '' }}>
                                                                    Tidak Aktif</option>
                                                            </select>
                                                            @error('status_poli')
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
@endpush
