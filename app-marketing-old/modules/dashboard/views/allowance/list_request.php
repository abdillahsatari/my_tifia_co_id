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
                                List Allowance Request
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-section">
                        <span class="m-section__sub">

                            <div class="btn-group mb-3" role="group">
                                <button type="button" class="btn btn-warning btn-sm" id="request_individual"><i class="fa fa-user"></i> Request Individual</button>
                                <button type="button" class="btn btn-warning btn-sm" id="request_all" data-href="<?= base_url() ?>dashboard/allowance_request/requestAll_action"><i class="fa fa-users"></i> Request All</button>
                            </div>

                        </span>

                        <div class="m-section__content">

                            <div class="table-responsive">
                                <!--begin: Datatable -->
                                <table class="table table-striped table-bordered table-hover" id="tableku">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Kode</th>
                                            <th>Mitra</th>
                                            <th>Amount Requested</th>
                                            <th>Date Requested</th>
                                            <th>Status</th>
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

<div class="modal fade" id="modalIndividual" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Allowance (Individual)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>dashboard/allowance_request/requestIndividual_action" method="POST" id="form1">

                    <div class="form-group">
                        <label class="" for="marketing_id">Marketing</label>
                        <select name="marketing_id" id="marketing_id" class="form-control">
                            <?php
                            foreach ($mkt as $r) {
                            ?>
                                <option value="<?= $r->id ?>"><?= $r->kode . ' / ' . $r->nama ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <!-- <div class="form-group">
                        <label class="" for="allowance">Email</label>
                        <input type="text" class="form-control" id="mkt_email" value="" disabled>
                    </div> -->

                    <div class="form-group">
                        <label class="" for="allowance">Amount</label>
                        <div class="input-group mb-3" id="allowance">
                            <div class="input-group-prepend">
                                <span class="input-group-text">IDR</span>
                            </div>
                            <input type="number" min="0" step="1000" class="form-control" name="allowance" value="">
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" id="submit1" class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        $(document).ready(function() {
            var dataTable = $('#tableku').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?= base_url() . 'dashboard/allowance_request/fetch_list'; ?>",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0, 1, 2, 5],
                    "orderable": false,
                }, ],
                'autoWidth': false
            });
        });

        // Request Individual

        $(document).on("click", "#request_individual", function(e) {
            $('#modalIndividual').modal('show');
        });

        $(document).on('submit', '#form1', function(e) {
            e.preventDefault();
            var me = $(this);
            $("#submit1").prop('disabled', true).html('<div class="spinner-border spinner-border-sm text-white"></div> Processing...');
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
                                    $("#modalIndividual").modal('hide');
                                    $("#tableku").DataTable().ajax.reload();
                                    // window.location.href = json.href;
                                }
                            });
                        } else {
                            $("#submit1").prop('disabled', false).html('Submit');
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
                        $("#submit1").prop('disabled', false)
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


        // Requsest All

        $(document).on("click", "#request_all", function(e) {
            e.preventDefault();
            $('.modal-dialog').removeClass('modal-lg')
                .removeClass('modal-sm')
                .addClass('modal-md');
            $("#modal-title").text('Request Allowance (All)');
            $("#modal-body").html(`
            <p>Anda yakin untuk melakukan <b>Request Allowance</b> pada Marketing dengan Allowance yang sudah ditentukan pada <a href="<?= base_url('dashboard/setting/customrevenue') ?>">Perhitungan Komisi</a>?</p>

            <div class="text-center">
                <button class="btn btn-success btn-sm" data-dismiss="modal">Tutup</button>
                <button class="btn btn-primary btn-sm" id="yaRequestAll">Ya, saya Yakin</button>
            </div>

            `);
            $("#modalKu").modal("show");
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

    });
</script>