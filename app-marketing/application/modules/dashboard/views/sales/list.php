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
                                List My Team
                            </h3>
                            <?php
                            $mitra = mitra(sess('mkt'));
                            if ($mitra['role_id'] != '5') {
                            ?>
                                <a href="<?= base_url('dashboard/sales/register') ?>" class="btn btn-sm btn-primary ml-3">
                                    <i class="fa fa-user-plus"></i> Tambah
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-section">
                        <span class="m-section__sub text-center">
                            <a href="<?= base_url('dashboard/sales/tree/' . sess('mkt')) ?>" class="btn btn-sm btn-primary ml-3">
                                <i class="fa fa-users"></i> Pohon Jaringan Saya
                            </a>
                        </span>
                        <div class="m-section__content">

                            <div class="table-responsive">
                                <!--begin: Datatable -->
                                <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="tableku">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No.</th>
                                            <th>Nama Mitra</th>
                                            <th>Jabatan</th>
                                            <th>Kontak</th>
                                            <th>Kota Asal</th>
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
                    url: "<?= base_url() . 'dashboard/sales/fetch_team'; ?>",
                    type: "POST"
                },
                "columnDefs": [{
                    "targets": [0, 1, 3, 4, 5],
                    "orderable": false,
                }, ],
                'autoWidth': false
            });
        });

    });
</script>