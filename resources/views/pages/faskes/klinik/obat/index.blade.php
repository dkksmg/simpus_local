@extends('layouts.app')
@push('addon-styles')
    {{-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link href="https://coreui.io/demos/bootstrap/4.3/default-v3/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css"
        rel="stylesheet">
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="fs-2 fw-semibold">Obat</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.dashboard') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item active"><span>Obat</span></li>
                </ol>
            </nav>
            <div class="card mb-4">
                <div class="card-header"><a class="badge bg-danger-gradient ms-2 text-decoration-none"
                        href="{{ route('faskes.obat.create') }}">Tambah Data Obat</a>
                </div>
                <div class="card-body">
                    <div class="example">
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-152">
                                <table class="table table-striped border datatable" id="faskes">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Obat</th>
                                            <th>Nama Obat</th>
                                            <th>Jenis Obat</th>
                                            <th>Dosis Obat</th>
                                            <th>Pabrik Obat</th>
                                            <th>Tarif Obat</th>
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
@endsection
@push('addon-scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    {{-- <script src="https://coreui.io/demos/bootstrap/4.3/default-v3/js/datatables.js"></script> --}}
    <script type="text/javascript">
        $(function() {
            $('#faskes').DataTable({
                processing: true,
                serverSide: true,
                statesave: true,
                ajax: "{!! url()->current() !!}",
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'kode_obat',
                    },
                    {
                        data: 'nama_obat',
                    },
                    {
                        data: 'jenis_obat',
                    },
                    {
                        data: 'dosis_obat',
                    },
                    {
                        data: 'pabrik_obat',
                    }, {
                        data: 'tarif_obat',
                    },
                    // {
                    //     data: 'status',
                    //     render: function(data) {
                    //         if (data === 'active') {
                    //             return '<span class="badge bg-success-gradient">Active</span>'
                    //         } else {
                    //             return '<span class="badge bg-dark-gradient">Inactive</span>'
                    //         }
                    //     }
                    // },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
    </script>
@endpush
