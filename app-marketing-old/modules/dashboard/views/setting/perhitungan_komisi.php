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
                                List
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-section">
                        <span class="m-section__sub">
                            <!--  -->
                        </span>
                        <div class="m-section__content">

                            <div class="table-responsive">
                                <!--begin: Datatable -->
                                <table class="table table-striped table-bordered table-hover" id="tableku">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Mitra</th>
                                            <th rowspan="2">Kategori</th>
                                            <th colspan="3">Revenue</th>
                                            <th rowspan="2">Action</th>
                                        </tr>
                                        <tr class="text-center">
                                            <th>Komisi Lot</th>
                                            <th>NMI</th>
                                            <th>Allowance</th>
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

        // DATATABLE

        $(document).ready(function() {
            var dataTable = $('#tableku').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?= base_url() . 'dashboard/setting/fetch_list'; ?>",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5, 6],
                    "orderable": false,
                }, ],
                'autoWidth': false
            });
        });

        $(document).on("click", "#modalEdit", function(e) {
            e.preventDefault();
            $('.modal-dialog').removeClass('modal-lg')
                .removeClass('modal-sm')
                .addClass('modal-md');
            $("#modal-title").text('Edit Revenue');
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
    });
</script>