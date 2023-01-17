<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register Mitra | PT. Tifia Finansial Berjangka</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/hyper/css/icons.min.css">
    <link rel="stylesheet" href="assets/hyper/css/app.min.css">
    <link rel="stylesheet" href="assets/hyper/css/fix.css">
    <link rel="shortcut icon" href="assets/demo/demo11/media/img/logo/favicon.ico" />

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
                    <div class="auth-brand text-center text-lg-left mb-3">
                        <a href="index.html">
                            <span><img style="max-height: 60px;" src="assets/hyper/images/black.png" alt="PT. Teknologi Finansial Berjangka"></span>
                        </a>
                    </div>

                    <!-- title-->
                    <h4 class="mt-4">Daftar Sekarang</h4>
                    <p class="text-muted mb-4">Belum punya akun? pendaftaran kini lebih mudah & sebentar saja!</p>

                    <?= $this->session->flashdata('message'); ?>
                    <!-- form -->
                    <form action="<?= base_url() ?>registration" method="POST" id="form">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input class="form-control" type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan nama" onkeypress="this.value = this.value.replace (/[^a-zA-Z _]/,'')" value="<?= set_value('nama_lengkap') ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="Masukan email" value="<?= set_value('email') ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Masukan password">
                        </div>
                        <div class="form-group">
                            <label for="password">Ulangi Password</label>
                            <input class="form-control" type="password" id="password2" name="password2" placeholder="Masukan password lagi">
                        </div>
                        <hr>

                        <?php
                        // cek apakah ada referral
                        if ($this->input->get('r')) {
                            $kode = $this->input->get('r');
                        ?>
                            <div class="form-group">
                                <label for="fullname">Kode Referral</label>
                                <input class="form-control" type="text" name="referral" id="referral" placeholder="Kode referral" value="<?= $kode ?>">
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
                            <button class="btn btn-primary btn-primary-red btn-block" type="submit" id="submit"><i class="mdi mdi-account-circle"></i> Daftar </button>
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
        <div class="auth-fluid-right text-center" style="background: url('<?= base_url() ?>assets/hyper/images/auth-marketing.jpg'); align-items: stretch; background-size: cover;">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">Live Begins!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i>Moving Forward! <i class="mdi mdi-format-quote-close"></i>
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


<script>
    document.addEventListener('DOMContentLoaded', function() {

        $(document).on('submit', '#form', function(e) {
            e.preventDefault();
            var me = $(this);
            $("#submit").prop('disabled', true).html('Loading...');
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

                        if (json.success == true) {

                            $.toast({
                                heading: 'Success',
                                text: json.alert,
                                position: 'top-right',
                                textAlign: 'left',
                                hideAfter: 2500,
                                icon: 'success',
                                afterHidden: function() {
                                    window.location.href = json.href;
                                }
                            });
                        } else {
                            $("#submit").prop('disabled', false).html('Daftar');
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
                            .html('Daftar');
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