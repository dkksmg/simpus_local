<div class="modal" id="diagnosaDaftar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Diagnosa - ICD-10</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="DiagnosaTable">
                    <thead>
                        <tr>
                            <th>ICD</th>
                            <th>Diagnosa</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
{{-- <!-- CoreUI and necessary plugins-->
<script src="{{ url('vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
<script src="{{ url('vendors/simplebar/js/simplebar.min.js') }}"></script>
<!-- Plugins and scripts required by this view-->
<script src="{{ url('vendors/@coreui/utils/js/coreui-utils.js') }}"></script> --}}
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
{{-- <script src="https://coreui.io/demos/bootstrap/4.3/default-v3/js/datatables.js"></script> --}}
<script type="text/javascript">
    $('#DiagnosaTable').DataTable({
        ajax: "{!! route('data.ajax.popup-icd') !!}",
        processing: true,
        serverSide: true,
        // responsive: true,
        deferRender: true,
        columns: [{
                data: 'kode_icd',
            },
            {
                data: 'diagnosis',
            },
        ]
    });

    function input(kode, diagnosa) {
        $('#icdx<?= $ke ?>').val(kode);
        $('#penyakit<?= $ke ?>').val(diagnosa);
        jQuery.noConflict();
        $('#diagnosaDaftar').modal('hide');
    }
</script>
{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}

{{-- <script type="text/javascript">
    $("#DiagnosaTable").dataTable().fnDestroy();
    $('#DiagnosaTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {{ route('data.ajax.popup-icd') }}
    });

    function input(kode, diagnosa) {
        console.log(diagnosa);
        $('#icdx{{ $ke }}').val(kode);
        $('#penyakit{{ $ke }}').val(diagnosa);
        $('#diagnosaDaftar').modal('hide');
    }
</script> --}}
