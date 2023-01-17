<!-- BEGIN: Subheader -->
<!-- <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title "> <h4 class="m-widget24__title">
                   Selamat datang! <?= $this->session->userdata('nsb_nama') ?>
                </h4></h3>
            </div>
           
        </div>
    </div>     -->
<div class="m-subheader">

    <div class="row">
        <div class="col-sm-12">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Riwayat Transaksi
                            </h3>
                        </div>
                    </div>

                </div>
                <div class="m-portlet__body">
                    <div class="table-responsive">
                        <!--begin: Datatable -->
                        <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Rekening</th>
                                    <th>Jumlah Setoran</th>
                                    <th>Sistem</th>
                                    <th>Jumlah Pembayaran</th>
                                    <th>Penggantian Biaya</th>
                                    <th>Bonus</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data as $r) { ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php
                                    $no++;
                                } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>