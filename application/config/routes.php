<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']        = 'login'; // login & register nasabah
$route['register']                  = 'login/registration';
// $route['kabinet']                   = 'kabinet';
$route['kabinet']                   = 'akuntrading';
$route['logout']                    = 'login/logout';
$route['verify']                    = 'login/verify';
$route['lupa_password']             = 'login/lupa_password';
// $route['(:any)']                    = 'pages/view/$1';
// $route['404_override']              = 'notfound'; // sebelum
$route['404_override']              = ''; // sesudah
$route['translate_uri_dashes']      = FALSE;
// LOGIN
$route['adminarea/login']           = 'adminarea/auth/login';
$route['adminarea/dashboard']       = 'adminarea/dashboard';
$route['user']                      = 'users';
$route['forgot_password']           = 'auth/forgot_password';

$route['pilihproduk']               = 'akuntrading/pilih_produk';
$route['pilihakun']                 = 'akuntrading/pilih_akun';
$route['completeregister']          = 'akuntrading/complete_register';

// ADMIN
$route['adminarea/dashboard']       = "adminarea/dashboard";
