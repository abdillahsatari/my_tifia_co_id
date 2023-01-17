<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Nasabahoff extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model('Nasabah_model');
		$this->load->model('Log_model');
		$this->load->model('Bank_model');
		$this->load->model('Acc_request_model');
		$this->load->model('Acc_trading_model');
		$this->load->model('Users_pesan_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}

	public function index(){
		$data['title'] = 'List Nasabah';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Nasabah' => '',
		];
		$data['code_js'] = 'nasabah/codejsoff';
		$data['page'] = 'nasabah/nasabahOff';
		$this->load->view('template/backend', $data);
	}

	public function json() {
		header('Content-Type: application/json');
		echo $this->Nasabah_model->jsonNasabaOff();
	}
    public function verifikasi_status($id){
        $status = "Complete";
		$data = array(
			'status' => $status,
		);

		if($this->Nasabah_model->update($id, $data)) // call the method from the model
		{
			$this->session->set_flashdata('message', 'Update Record gagal');
			redirect(site_url('adminarea/nasabah_varifikasi'));
		}
		else{
			$this->session->set_flashdata('message', 'Verifikasi sukses');
			redirect(site_url('adminarea/nasabah_varifikasi'));
		}
    }

}
