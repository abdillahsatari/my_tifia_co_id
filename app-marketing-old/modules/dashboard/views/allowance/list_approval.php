<!-- END: Subheader -->
<div class="m-subheader">


    <?= $this->session->flashdata('message') ?>


    <div class="row">

        <div class="col-lg-12">

            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                List Allowance Approval
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-section">
                        <span class="m-section__sub">
                        </span>

                        <div class="m-section__content">

                            <!-- Date range -->
                            <div class="form-group">
                                <label>Date range:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="date_range">
                                </div>
                                <!-- /.input group -->

                            </div>
                            <!-- /.form group -->


                            <!-- <button id="btnResetTable" class="btn bg-purple"><i class="fas fa-refresh"></i> Refresh table</button> -->

                            <div class="table-responsive">
                                <!--begin: Datatable -->
                                <table class="table table-striped table-bordered table-hover" id="tableku">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Kode</th>
                                            <th>Mitra</th>
                                            <th>Amount</th>
                                            <th>Date Requested</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        $(document).ready(function() {
            setDatatables();
        });
        $(document).on("click", "#btnResetTable", function() {
            setDatatables();
        });

        function setDatatables() {
            $("#tableku").dataTable().fnDestroy()
            var dataTable = $('#tableku').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?= base_url() . 'dashboard/allowance_approval/fetch_list'; ?>",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0, 1, 2, 3, 5, 6],
                    "orderable": false,
                }, ],
                'autoWidth': false
            });
        }

        $(document).on("click", ".applyBtn", function() {
            $("#tableku").dataTable().fnDestroy()
            var dataTable = $('#tableku').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?= base_url() . 'dashboard/allowance_approval/fetch_list'; ?>",
                    type: "POST",
                    data: {
                        'daterangepicker_start': $("input[name=daterangepicker_start]").val(),
                        'daterangepicker_end': $("input[name=daterangepicker_end]").val()
                    }
                },
                "columnDefs": [{
                    "targets": [0, 1, 2, 3, 5, 6],
                    "orderable": false,
                }, ],
                'autoWidth': false
            });
        });

        $(document).on("click", ".modalEdit", function(e) {
            e.preventDefault();
            $('.modal-dialog').removeClass('modal-lg')
                .removeClass('modal-sm')
                .addClass('modal-md');
            $("#modal-title").text('Allowance info');
            $("#modal-body").load($(this).data("href"));
            $("#modalKu").modal("show");
        });

        $(document).on('submit', '#form', function(e) {
            e.preventDefault();
            var me = $(this);
            $("#submit").prop('disabled', true).html('<div class="spinner-border spinner-border-sm text-white"></div> Processing...');
            $.ajax({
                url: me.attr('action'),
                type: 'post',
                data: new FormData(this),
                contentType: false,
                cache: false,
                dataType: 'JSON',
                processData: false,
                success: function(json) {
                    if (json.form_validation == true) {
                        $('.form-group').removeClass('.has-error')
                            .removeClass('.has');

                        if (json.success == true) {

                            $.toast({
                                heading: 'Success',
                                text: json.alert,
                                position: 'top-right',
                                textAlign: 'left',
                                hideAfter: 2500,
                                icon: 'success',
                                afterHidden: function() {
                                    $("#modalKu").modal('hide');
                                    $("#tableku").DataTable().ajax.reload();
                                    // window.location.href = json.href;
                                }
                            });
                        } else {
                            $("#submit").prop('disabled', false).html('Submit');
                            $.toast({
                                heading: 'Error',
                                text: json.alert,
                                position: 'top-right',
                                textAlign: 'left',
                                hideAfter: 5000,
                                icon: 'error'
                            });
                        }

                    } else {
                        $("#submit").prop('disabled', false)
                            .html('Submit');
                        $.each(json.alert, function(key, value) {
                            var element = $('#' + key);
                            $(element)
                                .closest('.form-group')
                                .find('.invalid-feedback-show').remove();
                            $(element).after(value);
                        });
                    }
                }
            });
        });

        $(document).on('click', '#yaRequestAll', function(e) {
            e.preventDefault();
            var me = $(this);
            me.prop('disabled', true).html('<div class="spinner-border spinner-border-sm text-white"></div> Processing...');
            $.ajax({
                url: '<?= base_url() ?>dashboard/allowance_request/requestAll_action',
                type: 'post',
                contentType: false,
                cache: false,
                dataType: 'JSON',
                processData: false,
                success: function(json) {

                    if (json.success == true) {

                        $.toast({
                            heading: 'Success',
                            text: json.alert,
                            position: 'top-right',
                            textAlign: 'left',
                            hideAfter: 2500,
                            icon: 'success',
                            afterHidden: function() {
                                $("#modalKu").modal('hide');
                                $("#tableku").DataTable().ajax.reload();
                                // window.location.href = json.href;
                            }
                        });
                    } else {
                        me.prop('disabled', true).html('<div class="spinner-border spinner-border-sm text-white"></div> Processing...');
                        $.toast({
                            heading: 'Error',
                            text: json.alert,
                            position: 'top-right',
                            textAlign: 'left',
                            hideAfter: 5000,
                            icon: 'error'
                        });
                    }
                }
            });
        });

        //Date range picker
        $('#date_range').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            }
        });

    });
</script>