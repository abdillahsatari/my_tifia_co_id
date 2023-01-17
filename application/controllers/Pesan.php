<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {

	 function __construct() {
	   parent::__construct();
	   cekLogin();
       $this->load->model(array('Users_pesan_model'));
	  	
    }
	
	public function index(){
		$data['feeds'] = $this->Users_pesan_model->get_all_by_nasabah_nolimit($this->session->userdata('cd_id'));
		$this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/pesan', $data);
        $this->load->view('templates/footer');
	}


}
 