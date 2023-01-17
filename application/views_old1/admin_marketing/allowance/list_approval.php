<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List Allowance Request</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Refresh">
                        <i class="fa fa-refresh"></i></button>
                </div>
            </div>

            <div class="box-body">

                <form id="myform" method="post" onsubmit="return false">

                    <div class="row" style="margin-bottom: 10px">
                        <div class="col-xs-12 col-md-4">
                            <!-- <div class="btn-group mb-3" role="group">
                                <button type="button" class="btn btn-warning btn-sm" id="request_individual"><i class="fa fa-user"></i> Request Individual</button>
                                <button type="button" class="btn btn-warning btn-sm" id="request_all" data-href="<?= base_url() ?>dashboard/allowance_request/requestAll_action"><i class="fa fa-users"></i> Request All</button>
                            </div> -->
                        </div>
                        <div class="col-xs-12 col-md-4 text-center">
                            <div style="margin-top: 4px" id="message">

                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4 text-right">
                            <?php echo anchor(site_url('adminarea/marketing/allowance_approval/excel'), '<i class="fa fa-file-excel"></i> Excel', 'class="btn btn-success"'); ?>
                            <!-- <?php echo anchor(site_url('adminarea/marketing/allowance_approval/word'), '<i class="fa fa-file-word"></i> Word', 'class="btn btn-primary"'); ?> -->

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tableku" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <!-- <th width=""></th> -->
                                    <th class="text-center">#</th>
                                    <th class="text-center">Kode</th>
                                    <th class="text-center">Mitra</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Amount Requested</th>
                                    <th class="text-center">Date Requested</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>


                        </table>
                    </div>
                    <!-- <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Hapus Data Terpilih</button> -->
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body"></div>
            <div class="modal-footer" id="modal-footer" style="display: none;">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
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
                    url: "<?= base_url() . 'adminarea/marketing/allowance_approval/fetch_list'; ?>",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7],
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

                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success('<a style="color:white"><p>' + json.alert + '</p></a>');

                            $("#modalKu").modal('hide');
                            $("#tableku").DataTable().ajax.reload();
                            // window.location.href = json.href;

                        } else {
                            $("#submit").prop('disabled', false).html('Submit');
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.error('<a style="color:white"><p>' + json.alert + '</p></a>');
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

    });
</script>