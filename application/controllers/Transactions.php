<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transactions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        // $this->load->model(array('Log_model'));
    }

    public function history()
    {
        $data['title'] = 'Riwayat Transaksi';
        $data['data'] = [];

        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/riwayat_transaksi', $data);
        $this->load->view('templates/footer');
    }

    public function index()
    {
        $this->history();
    }
}
