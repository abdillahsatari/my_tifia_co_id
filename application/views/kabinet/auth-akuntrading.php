<?php

$urlDesktop = 'https://download.mql5.com/cdn/web/17560/mt4/teknologiberjangka4setup.exe';
$urlIos = 'https://download.mql5.com/cdn/mobile/mt4/ios?server=TeknologiBerjangka-Demo,TeknologiBerjangka-MT4';
$urlAndroid = 'https://download.mql5.com/cdn/mobile/mt4/android?server=TeknologiBerjangka-Demo,TeknologiBerjangka-MT4';
?>

<!-- END: Subheader -->
<div class="m-subheader " id="loadakuntrading">


    <?php
    $tbl_nasalah = $this->db->query('SELECT status, komentar FROM nasabah WHERE nasabah_id="' . $this->session->userdata('cd_id') . '"')->row_array();

    if ($tbl_nasalah['status'] == 'Complete') {
    ?>
        <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
            <div class="m-alert__icon">
                <i class="fa fa-paper-plane"></i>
            </div>
            <div class="m-alert__text">
                Data Anda sedang diperiksa oleh Tim Kami.
            </div>
        </div>

    <?php
    } elseif ($tbl_nasalah['status'] == 'Register') {
    ?>
        <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
            <div class="m-alert__icon">
                <i class="fa fa-exclamation"></i>
            </div>
            <div class="m-alert__text">
                <a href="<?= base_url('registercomplete') ?>">Klik disini</a> untuk Pengisian Aplikasi Pendaftaran Nasabah.
            </div>
        </div>
    <?php
    } elseif ($tbl_nasalah['status'] == 'Checking') {
    ?>
        <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
            <div class="m-alert__icon">
                <i class="fa fa-exclamation-triangle text-red"></i>
            </div>
            <div class="m-alert__text">
                Verifikasi data gagal: [<?= $tbl_nasalah['komentar'] ?>]. Klik <a href="<?= base_url('registercomplete') ?>">disini</a> untuk melengkapi data Anda.
            </div>
        </div>
    <?php
    }

    ?>



    <?= $this->session->flashdata('message') ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">

                    <h4 class="">Akun Real</h4>

                    <div>

                        <table>
                            <tbody>
                                <tr>
                                    <td width="100px">ID Akun Real</td>
                                    <td width="20px">:</td>
                                    <td width="200px">
                                        <select name="select_akun_real" id="select_akun_real" class="form-control form-control-sm">
                                            <?php
                                            foreach ($akun_aktif['real'] as $r) {
                                            ?>
                                                <option value="<?= $r->no_akun ?>"><?= $r->no_akun ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Saldo</td>
                                    <td>:</td>
                                    <td id="saldo_akun_real"><i class="fas fa-circle-notch fa-spin"></i></td>
                                </tr>
<!--                                <tr>-->
<!--                                    <td>Profitabilitas</td>-->
<!--                                    <td>:</td>-->
<!--                                    <td id="prf_akun_real"><i class="fas fa-circle-notch fa-spin"></i></td>-->
<!--                                </tr>-->
                            </tbody>
                        </table>
                    </div>

                    <div class="m--space-30 m--margin-top-20 text-center">
                        <a class="btn btn-success btn-sm m-btn m-btn m-btn--icon m-btn--pill" id="bukaAkunTrading" href="#">
                            <span>
                                <i class="fa flaticon-paper-plane"></i>
                                <span>Membuka Akun Perdagangan</span>
                            </span>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">

                    <h4 class="">Akun Demo</h4>

                    <div>

                        <table>
                            <tbody>
                                <tr>
                                    <td width="100px">ID Akun Demo</td>
                                    <td width="20px">:</td>
                                    <td width="200px">
                                        <select name="select_akun_demo" id="select_akun_demo" class="form-control form-control-sm">
                                            <?php
                                            foreach ($akun_aktif['demo'] as $a => $r) {
                                            ?>
                                                <option value="<?= $r->no_akun ?>" <?= ($a == 0 ? 'selected' : '') ?>><?= $r->no_akun ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Saldo</td>
                                    <td>:</td>
                                    <td id="saldo_akun_demo"><i class="fas fa-circle-notch fa-spin"></i></td>
                                </tr>
<!--                                <tr>-->
<!--                                    <td>Profitabilitas</td>-->
<!--                                    <td>:</td>-->
<!--                                    <td id="prf_akun_demo"><i class="fas fa-circle-notch fa-spin"></i></td>-->
<!--                                </tr>-->
                            </tbody>
                        </table>
                    </div>


                    <div class="m--space-30 m--margin-top-20 text-center">
                        <a class="btn btn-success btn-sm m-btn m-btn m-btn--icon m-btn--pill" data-href="akuntrading/saveRequestDemo" id="bukaAkunDemo">
                            <span>
                                <i class="fa flaticon-paper-plane"></i>
                                <span>Membuka Akun Demo</span>
                            </span>
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
        <div class="m-alert__icon">
            <i class="fa fa-info-circle"></i>
        </div>
        <div class="m-alert__text">
            PT. Tifia Finansial Berjangka menyediakan fasilitas untuk Anda melakukan simulasi transaksi perdagangan dengan mendownload aplikasi MetaTrader <a href="tradingterminal">disini</a>.
        </div>
    </div>

    <div class="row ui-sortable" id="m_sortable_portlets">
        <div class="col-lg-8">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Daftar Akun Demo
                            </h3>
<!--                            <a href="--><?//= base_url() ?><!--akuntrading/test" class="btn btn-success btn-sm m-btn m-btn m-btn--icon m-btn--pill">-->
<!--                                Email testing-->
<!--                            </a>-->
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Section-->
                    <div class="m-section">
                        <span class="m-section__sub">
                            Sebelum pembuatan akun real, anda diwajibkan untuk membuat akun demo & telah melakukan simulasi, silihkan klik tombol 'Buka Akun Demo' untuk membuat akun demo
                        </span>
                        <div class="m-section__content">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Jenis Akun Demo</th>
                                            <th>Status</th>
                                            <th>No Akun</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($demo)) { ?>
                                            <tr>
                                                <td>-</td>
                                                <td><code>-</code></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                        <?php } else { ?>
                                            <?php foreach ($demo as $key => $value) { ?>
                                                <tr>
                                                    <td><?= $value->type ?></td>
                                                    <td><code><?= $value->status_request ?></code></td>
                                                    <td><?= $value->no_akun ?></td>
                                                    <td>
                                                        <?php if (!empty($value->no_akun)) { ?>
                                                            <button type="button" class="btn m-btn m-btn--pill m-btn--air m-btn--gradient-from-brand m-btn--gradient-to-info btn-sm" data-toggle="modal" data-target="#m_modal_<?= $value->no_akun ?>">Detail</button>
                                                        <?php include 'akundetail.php';
                                                        } ?>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="m--space-30 text-center">
                            <a class="btn btn-success btn-sm m-btn m-btn m-btn--icon m-btn--pill" href="akuntrading/saveRequestDemo">
                                <span>
                                    <i class="fa flaticon-paper-plane"></i>
                                    <span>Buka Akun Demo</span>
                                </span>
                            </a>
                        </div> -->
                    </div>
                    <!--end::Section-->
                </div>
            </div>
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Daftar Akun Real
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Jenis Akun Real</th>
                                            <th>Status</th>
                                            <th>No Akun</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($real)) { ?>
                                            <tr>
                                                <td>-</td>
                                                <td><code>-</code></td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                        <?php } else { ?>
                                            <?php foreach ($real as $key => $value) { ?>
                                                <tr>
                                                    <td><?= $value->type ?></td>
                                                    <td><code><?= $value->status_request ?></code></td>
                                                    <td><?= $value->no_akun ?></td>
                                                    <td>
                                                        <?php if ($value->status_request != 'Aktif') { ?>
                                                            <!-- <a class="btn btn-success btn-sm m-btn m-btn m-btn--icon m-btn--pill" href="registercomplete">
                                                                <span>
                                                                    <i class="fa flaticon-paper-plane"></i>
                                                                    <span>Selesaikan Registrasi!</span>
                                                                </span>
                                                            </a> -->
                                                        <?php } ?>
                                                        <?php if (!empty($value->no_akun)) { ?>
                                                            <button type="button" class="btn m-btn m-btn--pill m-btn--air m-btn--gradient-from-brand m-btn--gradient-to-info btn-sm" data-toggle="modal" data-target="#m_modal_<?= $value->no_akun ?>">Detail</button>
                                                        <?php include 'akundetail.php';
                                                        } ?>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="m--space-30 text-center">
                            <a class="btn btn-success btn-sm m-btn m-btn m-btn--icon m-btn--pill" <?php if (!empty($cekdemo)) { ?> href="pilihproduk" <?php } ?>>
                                <span>
                                    <i class="fa flaticon-paper-plane"></i>
                                    <span>Pengajuan Pembukaan Rekening Transaksi</span>
                                </span>
                            </a>
                        </div> -->
                    </div>
                    <!--end::Section-->
                </div>
            </div>
            <!--end::Portlet-->
        </div>

        <div class="col-lg-4">

            <div class="row">


                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="m-portlet m-portlet--tab">
                        <!-- <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Banner
                                        </h3>
                                    </div>
                                </div>
                            </div> -->
                        <div class="m-portlet__body">

                            <!-- <div class="row">
                                <div class="col-sm-12">
                                    <img src="<?= base_url() ?>uploads/banner/logo.png" alt="" class="img-fluid">
                                </div>
                            </div> -->

                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="<?= base_url() ?>uploads/banner/izin.png" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?= base_url() ?>uploads/banner/produk.png" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?= base_url() ?>uploads/banner/platform-trading.png" alt="Third slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="<?= base_url() ?>uploads/banner/tagline.png" alt="Fourth slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-6 col-lg-12">

                    <!-- activity log -->

                    <div class="m-portlet m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Aktifitas Terbaru
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="m_widget4_tab1_content">
                                    <div class="m-scrollable m-scroller ps ps--active-y" data-scrollable="true" data-height="400" style="height: 400px; overflow: hidden;">
                                        <div class="m-list-timeline m-list-timeline--skin-light">
                                            <div class="m-list-timeline__items">
                                                <?php foreach ($logtoday as $key => $value) { ?>
                                                    <div class="m-list-timeline__item">
                                                        <span class="m-list-timeline__badge m-list-timeline__badge--<?php if ($value->type == 'logout') { ?>danger<?php } elseif ($value->type == 'login') { ?>success<?php } else { ?>info<?php } ?>"></span>
                                                        <span class="m-list-timeline__text"><?= $value->aktifitas ?></span>

                                                        <span class="m-list-timeline__time"><?= date("d F Y, H:i", strtotime($value->tanggal)) ?></span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; height: 400px; right: 4px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 203px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="m_widget4_tab2_content">
                                </div>
                                <div class="tab-pane" id="m_widget4_tab3_content">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>



        </div>
    </div>

</div>

<div class="modal fade" id="modalAkunDemo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buka Akun Demo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url() ?>akuntrading/saveRequestDemo" id="form" method="POST">


                    <?php
                    $full_name = explode(" ", $this->session->userdata('nsb_nama'));
                    $name = ['first' => '', 'last' => ''];
                    foreach ($full_name as $key => $value) {
                        if ($key == 0) {
                            $name['first'] .= $value;
                        } else {
                            $name['last'] .= ' ' . $value;
                        }
                    }
                    ?>

                    <div class="form-group">
                        <label for="type">Name</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" value="<?= $name['first'] ?>" readonly>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" value="<?= $name['last'] ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $this->session->userdata('nsb_email') ?>" readonly>
                    </div>



                    <div class="form-group">
                        <label for="type2">Account Type</label>
                        <select name="type2" id="type2" class="form-control">
                            <option value="">-- Pilih --</option>
                            <?php
                            // get account type
                            $acc_type = $this->Acc_trading_model->get_acc_type('Demo');
                            foreach ($acc_type as $r) {
                                echo '<option value="' . $r->acc_type_id . '">' . $r->type . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="leverage2">Leverage</label>
                        <select name="leverage2" id="leverage2" class="form-control">
                            <option value="1">1:100</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="deposit">Deposit</label>
                        <select name="deposit" id="deposit" class="form-control">
                            <option value="">-- Select --</option>
                            <?php
                            $dp = ['3000', '5000', '10000', '25000', '50000', '100000', '500000', '1000000', '5000000'];
                            foreach ($dp as $value) {
                                echo '<option value="' . $value . '">USD ' . rupiah($value) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="text-center">
                        <button id="submit2" type="submit" class="btn btn-primary mt-3">Buat Akun Demo</button>
                    </div>

                </form>

            </div>
            <div class="modal-footer" style="display: none;">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- end:: Body -->

<script>
    document.addEventListener('DOMContentLoaded', function() {

        show_summary('#select_akun_demo', 'demo');
        show_summary('#select_akun_real', 'real');

        $('#select_akun_demo').on('change', function() {
            show_summary('#select_akun_demo', 'demo');
        });

        $('#select_akun_real').on('change', function() {
            show_summary('#select_akun_real', 'real');
        });

        function show_summary(id, jenis) {
            var no_akun = $(id).val();
            if (no_akun != null) {

                var formData = new FormData();
                formData.set('no_akun', no_akun);
                formData.set('jenis', jenis);

                $.ajax({
                    url: 'akuntrading/get_summary_akun',
                    data: formData,
                    type: 'post',
                    contentType: false,
                    cache: false,
                    dataType: 'JSON',
                    processData: false,
                    success: function(json) {
                        var obj = $.parseJSON(json.data.response);
                        if (json.status == true) {
                            $('#saldo_akun_' + jenis).html(obj["balance"]);
                        } else {
                            $('#saldo_akun_' + jenis).html(`<code>Account ID not found</code>`);
                            // $('#prf_akun_' + jenis).html('-');
                        }
                    }, error: (error) => {
                        console.log(JSON.stringify(error));
                    }
                });

            } else {
                $('#saldo_akun_' + jenis).html('-');
                $('#prf_akun_' + jenis).html('-');
            }
        }

        $(document).on("click", "#bukaAkunTrading", function(e) {
            e.preventDefault();

            $('.modal-dialog').removeClass('modal-lg')
                .removeClass('modal-sm')
                .addClass('modal-md');
            $("#modal-title").text('Buka Akun Perdagangan');
            $("#modal-body").load("<?= base_url() ?>akuntrading/modal_bukaAkunTrading");
            $("#modalKu").modal("show");
        });

        $(document).on("click", "#bukaAkunDemo", function(e) {
            e.preventDefault();

            $("#modalAkunDemo").modal("show");
        });

        $(document).on('submit', '#form_buatAkunReal, #form', function(e) {
            e.preventDefault();
            var me = $(this);
            $("#submit, #submit2").prop('disabled', true).html('<i class="fas fa-circle-notch fa-spin"></i>');
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

                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'Success!',
                                text: json.alert,
                                showConfirmButton: false,
                                timer: 2500
                            }).then(function() {
                                // console.log("success response : ", json.data);
                                window.location.href = json.href;
                            });
                        } else {
                            Swal.fire({
                                position: 'center',
                                type: 'error',
                                title: 'Error!',
                                text: json.alert,
                                showConfirmButton: false,
                                timer: 2500
                            }).then(function() {
                                // console.log("failed response : ", json.data);
                                $("#submit, #submit2").prop('disabled', false)
                                    .html('Buat Akun');
                            });
                        }

                    } else {
                        $("#submit, #submit2").prop('disabled', false)
                            .html('Buat Akun');
                        $.each(json.alert, function(key, value) {
                            var element = $('#' + key);
                            $(element)
                                .closest('.form-group')
                                .find('.invalid-feedback-show').remove();
                            $(element).after(value);
                        });
                    }
                }, error: (error) => {
                    console.log("Ada error : ",JSON.stringify(error));
                }
            });
        });

    });
</script>