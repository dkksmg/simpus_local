@extends('layouts.app')
@push('addon-styles')
    {{-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link href="https://coreui.io/demos/bootstrap/4.3/default-v3/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css"
        rel="stylesheet">
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="fs-2 fw-semibold">Pasien</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.dashboard') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item active"><span>Pasien</span></li>
                </ol>
            </nav>
            <div class="card mb-4">
                <div class="card-header"><a class="badge bg-danger-gradient ms-2 text-decoration-none"
                        href="{{ route('faskes.pasien.create') }}">Tambah Data Pasien Baru</a>
                </div>
                <div class="card-body">
                    <div class="example">
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-152">
                                <table class="table table-striped border datatable" id="pasien">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No CM</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Usia</th>
                                            <th>Tempat, Tanggal Lahir</th>
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
            $('#pasien').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: "{!! url()->current() !!}",
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'no_cm',
                    },
                    {
                        data: 'nik',
                    },
                    {
                        data: 'nama_pasien',
                    }, {
                        data: 'usia',
                    },
                    {
                        data: 'tgl_lahir',
                    }, {
                        data: 'alamat',
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
        $('body').on('click', '#btn-delete', function() {
            let data = $(this).data('id');
            let nama = $(this).data('nama');
            const hapus = '{{ route('faskes.pasien.destroy', ':id') }}'
            url_hapus = hapus.replace(':id', data)
            Swal.fire({
                    title: 'Apakah Anda yakin ?',
                    text: 'Anda akan menghapus Data ' + nama + '!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Tidak'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
                        $.ajax({
                            url: url_hapus,
                            type: "DELETE",
                            data: {
                                _token: CSRF_TOKEN,
                                id: data,
                                nama: nama
                            },
                            cache: false,
                            success: function(response) {
                                Swal.fire({
                                    type: 'success',
                                    icon: 'success',
                                    title: `${response.message}`,
                                    showConfirmButton: true,
                                    timer: 3000
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // location.reload()
                                        $("#pasien").DataTable().ajax.reload(null, false)
                                    } else {
                                        // location.reload()
                                        $("#pasien").DataTable().ajax.reload(null, false)

                                    }
                                })
                            },
                            error: function(response) {
                                Swal.fire({
                                    type: 'error',
                                    icon: 'error',
                                    title: `${response.message}`,
                                    showConfirmButton: true,
                                    timer: 3000
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // location.reload()
                                        $("#pasien").DataTable().ajax.reload(null, false)
                                    } else {
                                        // location.reload()
                                        $("#pasien").DataTable().ajax.reload(null, false)

                                    }
                                })
                            }
                        });
                    }
                })
        })
    </script>
@endpush
