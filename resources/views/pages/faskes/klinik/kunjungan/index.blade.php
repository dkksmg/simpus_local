@extends('layouts.app')
@push('addon-styles')
    <link href="https://coreui.io/demos/bootstrap/4.3/default-v3/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css"
        rel="stylesheet">
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="fs-2 fw-semibold">Kunjungan</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item active"><span>Kunjungan Pasien</span></li>
                </ol>
            </nav>
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Pencarian Pasien</h3>
                </div>
                <div class="card-body">
                    <div class="example">
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-152">
                                <div class="col-md-12">
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-2">Nama Pasien</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="nama_pasien" class="form-control"
                                                value="{{ old('nama_pasien') }}">
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row mb-2">
                                        <label class="col-sm-2">Nama KK</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="nama_pasien_kk" class="form-control"
                                                value="{{ old('nama_pasien_kk') }}">
                                        </div>
                                    </div> --}}
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-2">No CM</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="no_cm" class="form-control"
                                                value="{{ old('no_cm') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-2">NIK</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="nik" class="form-control"
                                                value="{{ old('nik') }}">
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row mb-2">
                                        <label class="col-sm-2">No IHS</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="no_ihs" class="form-control"
                                                value="{{ old('no_ihs') }}">
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-1 me-2">
                                        <div class="form-group row mt-3 mb-2">
                                            <button type="button" id="search" class="btn btn-success">Cari</button>
                                        </div>
                                    </div>
                                    <div class="col-md-1 me-2">
                                        <div class="form-group row mt-3 mb-2">
                                            <button type="button" id="clear" class="btn btn-warning">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="example">
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-152">
                                <div class="table-responsive">
                                    <table class="table table-striped border datatable" id="pasien">
                                        <thead>
                                            <tr>
                                                {{-- <th>ID IHS Pasien</th> --}}
                                                <th>No CM</th>
                                                <th>NIK</th>
                                                <th>Nama Pasien</th>
                                                <th>Usia</th>
                                                <th>TTL</th>
                                                <th>Alamat</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
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
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
        $('#search').on('click', function() {
            var namaPasien = $('[name=nama_pasien]').val();
            var noCM = $('[name=no_cm]').val();
            var nik = $('[name=nik]').val();
            // var namaKK = $('[name=nama_pasien_kk]').val();
            // var noIHS = $('[name=no_ihs]').val();

            console.log(namaPasien, noCM, nik)
            $.ajax({
                type: 'get',
                url: '{{ route('faskes.kunjungan.caripasien') }}',
                data: {
                    // namaKK: namaKK,
                    // noIHS: noIHS,
                    namaPasien: namaPasien,
                    noCM: noCM,
                    nik: nik,
                },
                dataType: 'json',
                beforeSend: function() {
                    Swal.fire({
                        title: 'Mencari Data',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                success: function(data) {
                    Swal.close()
                    if (data.recordsFiltered != 0) {
                        if ($.fn.dataTable.isDataTable('#pasien')) {
                            $('#pasien').dataTable().fnDestroy();
                        }
                        $('#pasien').DataTable({
                            data: data.data,
                            columns: [{
                                    data: 'no_cm'

                                },
                                {
                                    data: 'nik'
                                },
                                {
                                    data: 'nama_pasien'
                                },
                                {
                                    data: 'usia'
                                },
                                {
                                    data: 'tmp_lahir',
                                },
                                {
                                    data: 'alamat',
                                },
                                {
                                    data: 'action',
                                    name: 'action',
                                    orderable: true,
                                    searchable: true
                                },
                            ]
                        })
                    } else {
                        alert('Data Tidak Ditemukan');
                    }


                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: "Oops!",
                        text: 'Something went wrong',
                        timer: 6000,
                        showConfirmButton: true,
                    })
                }
            });
        })
        $('#clear').on('click', function() {
            $('[name=nama_pasien]').val('');
            $('[name=nama_pasien_kk]').val('');
            $('[name=no_cm]').val('');
            $('[name=nik]').val('');
            $('[name=no_ihs]').val('');
        })
    </script>
@endpush
