<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
    }

    public function index()
    {
        $data['title'] = 'Tinjauan';
        $data['afiliasi'] = [];

        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/affiliasi_tinjauan.php', $data);
        $this->load->view('templates/footer');
    }
}
