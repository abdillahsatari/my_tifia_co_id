<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Mitra | PT. Tifia Finansial Berjangka</title>
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
                    <div class="auth-brand text-center text-lg-center">
                        <a href="#">
                            <span><img style="max-height: 60px;" src="assets/hyper/images/black1.png" alt="PT. Tifia Finansial Berjangka"></span>
                        </a>
                    </div>

                    <!-- title-->
                    <h4 class="mt-0">Selamat datang di web Mitra TIFIA</h4>
                    <p class="text-muted mb-4">Masukan alamat email & password untuk masuk ke dashboard</p>

                    <!-- form -->
                    <?= $this->session->flashdata('message') ?>
                    <form action="login" method="POST">
                        <div class="form-group">
                            <label for="emailaddress">Alamat email</label>
                            <input class="form-control" type="email" id="emailaddress" required="" name="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <a href="lupa_password" class="text-muted float-right"><small>Lupa password?</small></a>
                            <label for="password">Password</label>
                            <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
                        </div>
                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                                <label class="custom-control-label" for="checkbox-signin">Ingatkan saya</label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-primary-red btn-block" type="submit"><i class="mdi mdi-login"></i> Masuk </button>
                        </div>
                        <!-- social-->

                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <!-- <p class="text-muted">Belum punya akun? <a href="register" class="text-muted ml-1"><b>Daftar Sekarang!</b></a></p> -->
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
    <script src="<?= base_url(); ?>assets/hyper/js/app.min.js"></script>

</body>

</html>