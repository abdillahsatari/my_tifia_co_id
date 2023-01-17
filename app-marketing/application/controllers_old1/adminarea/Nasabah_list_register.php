<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Nasabah_list_register extends CI_Controller
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
		$data['title'] = 'Nasabah Register';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Nasabah' => '',
		];
		$data['code_js'] = 'nasabah/codejsRegister';
		$data['page'] = 'nasabah/nasabah_list_register';
		$this->load->view('template/backend', $data);
	}

	public function json() {
		header('Content-Type: application/json');
		echo $this->Nasabah_model->jsonRegister();
	}
	// verifikasi email manual
	public function verifikasi_email($id)
	{
		$data = ['status_verify' => 'Y'];

		if ($this->Nasabah_model->update($id, $data)) // call the method from the model
		{
			$this->session->set_flashdata('message', 'Update Record gagal');
			redirect(site_url('adminarea/nasabah_list_register'));
		} else {
			$this->session->set_flashdata('message', 'Verifikasi sukses');
			redirect(site_url('adminarea/nasabah_list_register'));
		}
	}
	// verifikasi_status = 	Complete manual
	public function verifikasi_status($id){
		$data = $this->Acc_trading_model->get_by_id_nasabah($id);
		if (empty($data)){
			$this->session->set_flashdata('message', 'data belum lengkap');
			redirect(site_url('adminarea/nasabah_list_register'));
		}
		else{
			$status = "Complete";
			$newdata = array(
				'status' => $status,
			);
			$this->Nasabah_model->update($id, $newdata);
			$this->session->set_flashdata('message', 'Verifikasi sukses');
			redirect(site_url('adminarea/nasabah_list_register'));
		}

    }





}
