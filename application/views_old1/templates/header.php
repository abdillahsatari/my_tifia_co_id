<?php

const THEME_BLACK = false;
const THEME_WHITE = true;

$userTheme = $this->session->userdata('theme');

$theme = 'white';
if (isset($userTheme) && $userTheme == 1) {
    $theme = 'black';
}

//debug($this->session->userdata('theme'));
?>
<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->

<head>
    <meta charset="utf-8" />
    <title>PT. Tifia Finansial Berjangka | Official Kabinet </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <script src="<?= base_url() ?>assets/vendors/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <link href="<?= base_url() ?>assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/demo/demo11/base/style.bundle.clear-theme.css" rel="stylesheet" type="text/css" />
    <?php if ($theme == 'black') { ?>
        <link href="<?= base_url() ?>assets/demo/demo11/base/theme.black.css" rel="stylesheet" type="text/css" />
    <?php } else { ?>
        <link href="<?= base_url() ?>assets/demo/demo11/base/theme.white.css" rel="stylesheet" type="text/css" />
    <?php } ?>

    <link href="<?= base_url() ?>assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?= base_url() ?>assets/demo/demo11/media/img/logo/favicon1.ico" />
    <!-- <script src="https://use.fontawesome.com/6c3ef929ff.js"></script> -->

    <!-- custom -->
    <link href="<?= base_url() ?>assets/vendors/custom/jquery-toast-plugin/jquery.toast.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/vendors/custom/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

    <style>
        .invalid-feedback,
        .invalid-feedback-show {
            width: 100%;
            margin-top: .25rem;
            margin-bottom: .60rem;
            font-size: 1rem;
            color: #ed3237;
        }

        .text-danger {
            color: #c33232 !important;
        }

        .form-control.focus,
        .form-control:focus {
            border-color: #c33232;
        }


        .btn.btn-outline-primary {
            color: #c33232;
        }

        .btn-outline-primary {
            color: #c33232;
            background-color: transparent;
            background-image: none;
            border-color: #c33232;
        }

        .btn-outline-primary.focus,
        .btn-outline-primary:focus,
        .btn-outline-primary:hover {
            border-color: #c33232;
            background: #c33232;
            color: #fff;
        }

        /* sidebar */

        .m-aside-menu.m-aside-menu--skin-light {
            background-color: #28282b;
        }

        .m-aside-left.m-aside-left--skin-light {
            background-color: #28282b;
        }

        .m-aside-menu.m-aside-menu--skin-light .m-menu__nav>.m-menu__item>.m-menu__heading .m-menu__link-icon,
        .m-aside-menu.m-aside-menu--skin-light .m-menu__nav>.m-menu__item>.m-menu__link .m-menu__link-icon {
            color: #ffffff;
        }

        body#white .m-aside-menu.m-aside-menu--skin-light .m-menu__nav>.m-menu__item.m-menu__item--active>.m-menu__heading,
        .m-aside-menu.m-aside-menu--skin-light .m-menu__nav>.m-menu__item.m-menu__item--active>.m-menu__link {
            background-color: #202123;
        }

        .m-aside-menu.m-aside-menu--skin-light .m-menu__nav>.m-menu__item>.m-menu__heading .m-menu__link-text,
        .m-aside-menu.m-aside-menu--skin-light .m-menu__nav>.m-menu__item>.m-menu__link .m-menu__link-text {
            color: #ffffff;
        }

        body#white .m-aside-menu.m-aside-menu--skin-light .m-menu__nav>.m-menu__item.m-menu__item--active>.m-menu__heading .m-menu__link-icon,
        .m-aside-menu.m-aside-menu--skin-light .m-menu__nav>.m-menu__item.m-menu__item--active>.m-menu__link .m-menu__link-icon,
        .m-aside-menu.m-aside-menu--skin-light .m-menu__nav>.m-menu__item.m-menu__item--active>.m-menu__heading .m-menu__link-text,
        .m-aside-menu.m-aside-menu--skin-light .m-menu__nav>.m-menu__item.m-menu__item--active>.m-menu__link .m-menu__link-text {
            color: #ffffff;
        }
    </style>
</head>
<!-- end::Head -->