<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registercomplete extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('cekLogin');
        cekLogin();
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/auth-registercomplete-spa');
        $this->load->view('templates/footer');
    }
}
