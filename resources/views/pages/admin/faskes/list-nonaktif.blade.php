@extends('layouts.app')
@push('addon-styles')
    {{-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link href="https://coreui.io/demos/bootstrap/4.3/default-v3/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css"
        rel="stylesheet">
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="fs-2 fw-semibold">Faskes Nonaktif</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item active"><span>Faskes Nonaktif</span></li>
                </ol>
            </nav>
            <div class="col-md-12">
                <div class="card mb-4">
                    {{-- <div class="card-header"><a class="badge bg-danger-gradient ms-2 text-decoration-none"
                        href="{{ route('faskes.create') }}">Tambah Data Faskes</a>
                </div> --}}
                    <div class="card-body">
                        <div class="example">
                            <div class="tab-content rounded-bottom">
                                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-152">
                                    <div class="table-responsive">

                                        <table class="table table-striped" id="faskes">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Kode Faskes</th>
                                                    <th class="text-center">Nama Faskes</th>
                                                    <th class="text-center">PJ Faskes</th>
                                                    <th class="text-center">Kontak Faskes</th>
                                                    <th class="text-center">Lokasi Faskes</th>
                                                    <th class="text-center">Role</th>
                                                    <th class="text-center">Delete At</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Aksi</th>
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
    </div>
@endsection
@push('addon-scripts')
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://coreui.io/demos/bootstrap/4.3/default-v3/js/datatables.js"></script> --}}
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        var table;
        $(document).ready(function() {
            $('#faskes thead th').each(function() {
                var title = $(this).text();
                if (title != 'No' && title != 'Aksi') {
                    $(this).html(title + '<input type="text" style="width:120px;" placeholder=" ' + title +
                        '" />');
                }
            });
        });
        $(function() {
            $('#faskes').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! url()->current() !!}",
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'kode_faskes',
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'detail_faskes.nama_pimpinan',
                    }, {
                        data: 'email',
                    }, {
                        data: 'detail_faskes.alamat_faskes',
                    }, {
                        data: 'role',
                    }, {
                        data: 'deleted_at',
                    },
                    {
                        data: 'detail_faskes.status',
                        render: function(data) {
                            if (data === 'active') {
                                return '<span class="badge bg-success-gradient">Active</span>'
                            } else {
                                return '<span class="badge bg-dark-gradient">Inactive</span>'
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
                columnDefs: [{
                    targets: [0, 8, 9], //first column     / numbering column
                    orderable: false,
                }, ],
            });

        });
    </script>
@endpush
