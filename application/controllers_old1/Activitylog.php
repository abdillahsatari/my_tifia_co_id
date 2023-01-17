<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activitylog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        $this->load->model(array('Log_model'));
    }

    public function index()
    {
        $data['title'] = 'Log Aktifitas';
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['logtoday'] = $this->Log_model->get_by_nasabah_id($this->session->userdata('cd_id'));

        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/activity_log', $data);
        $this->load->view('templates/footer');
    }
}
