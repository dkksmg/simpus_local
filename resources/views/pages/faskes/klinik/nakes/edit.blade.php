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
                    <li class="breadcrumb-item active"><span>Edit</span></li>
                </ol>
            </nav>
            <form action="{{ route('faskes.nakes.update', Crypt::encrypt($nakes->kode_nakes)) }}" method="POST">
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
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="kode_nakes">Kode
                                                                Nakes</label>
                                                            <input
                                                                class="form-control-plaintext @error('kode_nakes') is-invalid @enderror"
                                                                id="kode_nakes" type="text" name="kode_nakes" readonly
                                                                value="{{ $nakes->kode_nakes }}">
                                                            @error('kode_nakes')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="nama_nakes">Nama
                                                                Nakes</label>
                                                            <input
                                                                class="form-control @error('nama_nakes') is-invalid @enderror"
                                                                id="nama_nakes" type="text" name="nama_nakes"
                                                                value="{{ $nakes->nama_nakes }}">
                                                            @error('nama_nakes')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="jabatan_nakes">Jabatan
                                                                Nakes</label>
                                                            <select class="form-select" name="jabatan_nakes">
                                                                <option value=""></option>
                                                                @foreach ($jabatan as $jab)
                                                                    <option value="{{ $jab->id }}"
                                                                        {{ $jab->id == $nakes->jabatan_nakes ? 'selected' : '' }}>
                                                                        {{ $jab->nama_jabatan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('jabatan_nakes')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="status_nakes">Status</label>
                                                            <select class="form-select" name="status_nakes">
                                                                <option value=""></option>
                                                                <option value="active"
                                                                    {{ $nakes->status == 'active' ? 'selected' : '' }}>
                                                                    Aktif</option>
                                                                <option value="inactive"
                                                                    {{ $nakes->status == 'inactive' ? 'selected' : '' }}>
                                                                    Tidak aktif</option>
                                                            </select>
                                                            @error('status_nakes')
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
@endpush
