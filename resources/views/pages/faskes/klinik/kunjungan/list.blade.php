@extends('layouts.app')
@push('addon-styles')
    {{-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link href="https://coreui.io/demos/bootstrap/4.3/default-v3/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css"
        rel="stylesheet">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="fs-2 fw-semibold">List Kunjungan</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item active"><span>List Kunjungan Pasien</span></li>
                </ol>
            </nav>
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Filter Tanggal</h3>
                </div>
                <div class="card-body">
                    <div class="example">
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-152">
                                <div class="col-md-12">
                                    <div class="form-group row mb-2">
                                        <label class="col-sm-2">Tanggal</label>
                                        <div class="col-sm-4">
                                            <input type="text" id="datepicker" name="tanggal" class="form-control"
                                                value="{{ old('tanggal') == null ? \Carbon\Carbon::now()->format('d-m-Y') : old('tanggal') }}"
                                                {{-- value="{{ old('tanggal') }}" --}} placeholder="Filter tanggal">
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
                                                {{-- <th>ID Kunjungan</th> --}}
                                                {{-- <th>ID IHS Pasien</th> --}}
                                                {{-- <th>ID Encounter</th> --}}
                                                <th>Tgl Kunjungan</th>
                                                <th>Status</th>
                                                <th>No CM</th>
                                                <th>NIK</th>
                                                <th>Nama Pasien</th>
                                                <th>Usia</th>
                                                <th>Poli</th>
                                                <th>TTL</th>
                                                {{-- <th>Alamat</th> --}}
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
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'materialicons',
            showOnFocus: true,
            showRightIcon: false,
            format: 'dd-mm-yyyy',
        });
    </script>
    <script type="text/javascript">
        function dateNow() {
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1; // Months start at 0!
            let dd = today.getDate();

            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;

            return formattedToday = dd + '-' + mm + '-' + yyyy;
        }

        $('[name=tanggal]').on('change', function() {
            var date = $(this).val();
            if (date != '') {
                fetch_data(date);
            } else {
                alert('Tanggal tidak boleh kosong');
            }
        });

        fetch_data();

        function fetch_data(date) {
            $.ajaxSetup({
                headers: {
                    'csrftoken': '{{ csrf_token() }}'
                }
            });
            if (date == undefined) {
                var tanggal = dateNow()
            } else {
                var tanggal = date
            }
            $.ajax({
                type: 'get',
                url: '{{ route('faskes.kunjungan.data-list') }}',
                data: {
                    tgl: tanggal,
                },
                dataType: 'json',
                success: function(data) {
                    if (data.recordsFiltered != '' ||
                        data.recordsFiltered != 0) {
                        if ($.fn.dataTable.isDataTable('#pasien')) {
                            $('#pasien').dataTable().fnDestroy();
                        }
                        $('#pasien').DataTable({
                            data: data.data,
                            columns: [{
                                    data: 'tgl_kunjungan',
                                },
                                {
                                    data: 'status_kunjungan'

                                }, {
                                    data: 'no_cm'

                                },
                                {
                                    data: 'detail_pasien.nik'
                                },
                                {
                                    data: 'detail_pasien.nama_pasien'
                                },
                                {
                                    data: 'usia'
                                },
                                {
                                    data: 'detail_poli.nama_poli'
                                },

                                {
                                    data: 'detail_pasien.tgl_lahir',
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
                        // alert('Tidak ada kunjungan di tanggal ' + tanggal);
                    }
                },
                error: function() {
                    alert('Data Tidak Ditemukan');
                }
            });
        }
    </script>
@endpush
