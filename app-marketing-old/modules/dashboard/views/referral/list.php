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
                                List Referral
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
                                            <th>#</th>
                                            <th>Nama Nasabah</th>
                                            <th>E-mail</th>
                                            <th>No. HP</th>
                                            <th>Akun Perdagangan</th>
                                            <th>Balance</th>
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


<script>
    document.addEventListener('DOMContentLoaded', function() {

        $(document).ready(function() {
            var dataTable = $('#tableku').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?= base_url() . 'dashboard/referral/fetch_list'; ?>",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5, 6],
                    "orderable": false,
                }, ],
                'autoWidth': false
            });
        });

    });
</script>