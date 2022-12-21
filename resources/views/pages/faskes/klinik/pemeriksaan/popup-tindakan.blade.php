<div class="modal" id="tindakanDaftar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tindakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="DiagnosaTable">
                    <thead>
                        <tr>
                            <th>Kode Tindakan</th>
                            <th>Detail Tindakan</th>
                            <th>Tarif Tindakan</th>
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
{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
{{-- <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script> --}}
<script type="text/javascript">
    $('#DiagnosaTable').DataTable({
        ajax: "{!! route('data.ajax.popup-tindakan') !!}",
        processing: true,
        serverSide: true,
        // responsive: true,
        deferRender: true,
        columns: [{
                data: 'kode_tindakan',
            },
            {
                data: 'detail_tindakan',
            }, {
                data: 'tarif_tindakan',
            },
        ]
    });

    function input(kode, tindakan) {
        $('#kodeTindakan<?= $ke ?>').val(kode);
        $('#Tindakan<?= $ke ?>').val(tindakan);
        jQuery.noConflict();
        $('#tindakanDaftar').modal('hide');
    }
</script>
{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}
