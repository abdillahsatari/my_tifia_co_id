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
    <!--begin:: Widgets/Stats-->
    <div class="m-portlet ">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Total Deposit
                            </h4><br>
                            <br>
                            <span class="m-widget24__stats m--font-brand">
                                <!-- Rp.150.000.000,- -->
                                <?= number_format($deposit->jml) ?>
                            </span>
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-brand" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="m-widget24__change">
                                Deposit masuk
                            </span>
                        </div>
                    </div>

                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Total Withdrawal
                            </h4><br>
                            <br>
                            <span class="m-widget24__stats m--font-info">
                                <!-- Rp.200.000.000,- -->
                                <?= number_format($wd->jml) ?>
                            </span>
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-info" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="m-widget24__change">
                                Withdrawal berhasil
                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Jumlah Akun Real
                            </h4><br>
                            <span class="m-widget24__desc">
                                <!-- 2 Akun -->
                                <?= $acc->jml ?> Akun
                            </span>

                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-success" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="m-widget24__change">
                                Akun trading anda
                            </span>

                        </div>
                    </div>

                    <!--end::New Orders-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">


                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Jumlah Akun Demo
                            </h4><br>
                            <span class="m-widget24__desc">
                                <?= $acc->jml ?> Akun
                            </span>

                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-success" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="m-widget24__change">
                                Akun demo anda
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end:: Widgets/Stats-->
</div>

<div class="m-content">
    <div class="row">
        <div class="col-xl-8">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Feeds
                            </h3>
                        </div>
                    </div>

                </div>
                <div class="m-portlet__body">

                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap" id="m_table_1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Subjek</th>
                                <!-- <th>Isi Pesan</th> -->
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($feeds as $key => $value) { ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $value->subject ?></td>
                                    <td><?= date("d F Y, H:i", strtotime($value->date)) ?></td>
                                    <td><button type="button" class="btn m-btn m-btn--pill m-btn--air m-btn--gradient-from-brand m-btn--gradient-to-info" data-toggle="modal" data-target="#m_modal_<?= $value->users_pesan_id ?>">Buka Pesan</button></td>
                                </tr>
                            <?php include 'feedsdetail.php';
                                $no++;
                            } ?>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>

<!-- end:: Body -->