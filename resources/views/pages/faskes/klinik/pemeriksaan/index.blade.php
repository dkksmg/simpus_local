@extends('layouts.app')
@push('addon-styles')
    {{-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link href="https://coreui.io/demos/bootstrap/4.3/default-v3/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css"
        rel="stylesheet">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="fs-2 fw-semibold">Rekam Medis</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.dashboard') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item active"><span>Rekam Medis</span></li>
                </ol>
            </nav>
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Cari Data Pasien</h3>
                </div>
                <div class="card-body">
                    <div class="example">
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-152">
                                <div class="col-md-12">
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-2">Poli</label>
                                        <div class="col-sm-4">
                                            <select name="poli" id="" class="form-select">
                                                @foreach ($ruangan as $rg)
                                                    <option value="{{ $rg->kode_poli }}">{{ $rg->nama_poli }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-2">Tanggal</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="tgl_pilih" class="form-control"
                                                value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" id="datepicker"
                                                required>
                                        </div>
                                    </div>
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
                                                {{-- <th>ID Encounter</th> --}}
                                                <th>Kode Kunjungan</th>
                                                <th>Tgl Kunjungan</th>
                                                <th>Poli</th>
                                                <th>NO CM</th>
                                                <th>NIK</th>
                                                <th>Nama Pasien</th>
                                                <th>Usia</th>
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
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://coreui.io/demos/bootstrap/4.3/default-v3/js/datatables.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'materialicons',
            showOnFocus: true,
            showRightIcon: false,
            format: 'dd-mm-yyyy',
            modal: true
        });
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
        $('#search').on('click', function() {
            var poli = $('[name=poli]').val();
            var tgl = $('[name=tgl_pilih]').val();
            if (tgl == null || tgl == "") {
                alert("Tanggal tidak boleh kosong");
            } else {
                $.ajax({
                    type: 'get',
                    url: '{{ route('faskes.catat.cari') }}',
                    data: {
                        poli: poli,
                        tgl: tgl,
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        if (data.recordsFiltered != 0) {
                            if ($.fn.dataTable.isDataTable('#pasien')) {
                                $('#pasien').dataTable().fnDestroy();
                            }
                            $('#pasien').DataTable({
                                data: data.data,
                                columns: [{
                                        data: 'id_kunjungan'
                                    },
                                    {
                                        data: 'tgl_kunjungan'
                                    },
                                    {
                                        data: 'detail_poli.nama_poli'
                                    },
                                    {
                                        data: 'no_cm'
                                    },
                                    {
                                        data: 'detail_pasien.nik'
                                    },
                                    {
                                        data: 'detail_pasien.nama_pasien'
                                    },
                                    {
                                        data: 'usia',
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
                            alert('Tidak ada data pasien');
                        }


                    },
                    error: function() {
                        alert('Error mendapatkan data pasien');
                    }
                });
            }

        })
        $('#clear').on('click', function() {
            $('[name=tgl_pilih]').val('');
        })
        $('.js-example-basic-single').select2({
            placeholder: 'Select an option'
        });
    </script>
@endpush
