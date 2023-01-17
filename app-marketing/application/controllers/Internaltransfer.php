<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Internaltransfer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        // $this->load->model(array('Log_model'));
    }

    public function index()
    {
        $data['title'] = 'Internal Transfer';

        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/internal_transfer', $data);
        $this->load->view('templates/footer');
    }

    public function transfer_action()
    {
        if ($this->input->is_ajax_request()) {
            $json = array('form_validation' => false, 'success' => false, 'alert' => array(), 'href' => '');

            $this->form_validation->set_rules('akun_asal', 'akun asal', 'trim|required|xss_clean');
            $this->form_validation->set_rules('akun_tujuan', 'akun tujuan', 'trim|required|xss_clean');
            $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required|numeric|greater_than[0]');
            $this->form_validation->set_rules('komentar', 'komentar', 'trim|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

            if ($this->form_validation->run()) {
                $json['form_validation'] = TRUE;
                $json['success'] = true;
                $json['alert'] = 'test';
            } else {
                foreach ($_POST as $key => $value) {
                    $json['alert'][$key] = form_error($key);
                }
            }

            echo json_encode($json);
        }
    }
}
