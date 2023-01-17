<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register| PT. Tifia Finansial Berjangka Official Website Kabinet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/hyper/css/icons.min.css">
    <link rel="stylesheet" href="assets/hyper/css/app.min.css">
    <link rel="stylesheet" href="assets/hyper/css/fix.css">
    <link rel="shortcut icon" href="assets/demo/demo11/media/img/logo/favicon1.ico" />

    <style>
        .invalid-feedback,
        .invalid-feedback-show {
            width: 100%;
            margin-top: .25rem;
            margin-bottom: .60rem;
            font-size: 0.75rem;
            color: #ed3237;
        }
    </style>
</head>

<body class="auth-fluid-pages pb-0">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="auth-brand">
                        <a href="index.html">
                            <span><img style="width: 70%;" src="assets/hyper/images/black.svg" alt="PT. Tifia Finansial Berjangka"></span>
                        </a>
                    </div>

                    <!-- title-->
                    <h4 class="mt-4">Daftar Sekarang</h4>
                    <p class="text-muted mb-4">Belum punya akun? pendaftaran kini lebih mudah & sebentar saja!</p>

                    <?= $this->session->flashdata('message'); ?>
                    <!-- form -->
                    <form action="register" method="POST">
                        <div class="form-group">
                            <label for="emailaddress">Nama Lengkap</label>
                            <input class="form-control" type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan nama" onkeypress="this.value = this.value.replace (/[^a-zA-Z _]/,'')" value="<?= set_value('nama_lengkap') ?>">
                            <?= form_error('nama_lengkap'); ?>
                        </div>
                        <div class="form-group">
                            <label for="emailaddress">Alamat Email</label>
                            <input class="form-control" type="email" id="emailaddress" name="email" placeholder="Masukan email" value="<?= set_value('email') ?>">
                            <?= form_error('email'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Masukan password">
                            <?= form_error('password'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Ulangi Password</label>
                            <input class="form-control" type="password" id="password2" name="password2" placeholder="Masukan password lagi">
                        </div>
                        <hr>
                        <?php

                        if ($this->input->get('t') && ($this->input->get('t') == 'Multilateral' || $this->input->get('t') == 'SPA')) {
                            $t = $this->input->get('t');
                        ?>
                            <div class="form-group" style="display: none;">
                                <label for="tipe">Kategori</label>
                                <select name="tipe" id="" class="form-control">
                                    <!-- <option value="">-- Pilih --</option> -->
                                    <option value="SPA" <?= ($t == 'SPA' ? 'selected' : '') ?>>Sistem Perdagangan Atlternatif (SPA)</option>
                                    <option value="Multilateral" <?= ($t == 'Multilateral' ? 'selected' : '') ?>>Multilateral</option>
                                </select>
                                <?= form_error('tipe'); ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="form-group">
                                <label for="tipe">Kategori</label>
                                <select name="tipe" id="" class="form-control">
                                    <!-- <option value="">-- Pilih --</option> -->
                                    <option value="SPA">Sistem Perdagangan Atlternatif (SPA)</option>
                                    <option value="Multilateral">Multilateral</option>
                                </select>
                                <?= form_error('tipe'); ?>
                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        // cek apakah ada referral
                        if ($this->input->get('r') || set_value('referral')) {
                            $kode = $this->input->get('r');
                        ?>
                            <div class="form-group">
                                <label for="fullname">Kode Referral</label>
                                <input class="form-control" type="text" name="referral" id="referral" placeholder="Kode referral" value="<?= (set_value('referral') == '' ? $kode : set_value('referral'))  ?>">
                                <?= form_error('referral'); ?>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkbox-signup" required="required">
                                <label class="custom-control-label" for="checkbox-signup">Dengan mendaftar, saya menyetujui <a href="javascript: void(0);" class="text-muted">Syarat dan Ketentuan</a> atau <a href="javascript: void(0);" class="text-muted"> Kebijkan Privasi</a> </label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-primary-red btn-block" type="submit"><i class="mdi mdi-account-circle"></i> Daftar </button>
                        </div>
                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Sudah punya akun PT. Tifia Finansial Berjangka? <a href="login" class="text-muted ml-1"><b>Masuk</b></a></p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">Break Limits</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> Dream Big, Set Goals & Take Action! . <i class="mdi mdi-format-quote-close"></i>
                </p>
                <p>
                    - PT. Tifia Finansial Berjangka -
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->

    <!-- App js -->
    <script src="assets/hyper/js/app.min.js"></script>

</body>

</html>