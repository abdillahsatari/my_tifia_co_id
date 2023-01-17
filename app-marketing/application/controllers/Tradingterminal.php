<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tradingterminal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
    }

    public function index()
    {
        $data['title'] = 'Download Terminal Niaga';

        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/terminal_niaga.php', $data);
        $this->load->view('templates/footer');
    }

    public function terminal()
    {
        $data['title'] = 'Terminal Niaga';

        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/terminal_niaga_live.php', $data);
        $this->load->view('templates/footer');
    }
}
