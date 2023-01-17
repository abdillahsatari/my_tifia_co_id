<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lupa password | PT. Tifia Finansial Berjangka</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/hyper/css/icons.min.css">
    <link rel="stylesheet" href="assets/hyper/css/app.min.css">
    <link rel="stylesheet" href="assets/hyper/css/fix.css">
    <link rel="shortcut icon" href="assets/demo/demo11/media/img/logo/favicon.ico" />
</head>

<body class="auth-fluid-pages pb-0">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="auth-brand text-center text-lg-left">
                        <a href="#">
                            <span><img style="max-height: 60px;" src="assets/hyper/images/black.png" alt="PT. Teknologi Finansial Berjangka"></span>
                        </a>
                    </div>

                    <h4 class="mt-0">Lupa Password? Jangan khawatir</h4>
                    <p class="text-muted mb-4">Masukan alamat email, sistem kami akan mengirimkan password baru ke email anda.</p>
                    <?= $this->session->flashdata('message'); ?>
                    <!-- form -->
                    <form action="lupa_password" method="post">
                        <div class="form-group mb-3">
                            <label for="email">Alamat Email</label>
                            <input class="form-control" type="email" id="email" name="email" required="" placeholder="Masukan alamat email" value="<?php echo set_value('email'); ?>">
                            <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-primary-red btn-block" type="submit"><i class="mdi mdi-lock-reset"></i> Reset Password </button>
                        </div>

                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Back to <a href="login" class="text-muted ml-1"><b>Log In</b></a></p>
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