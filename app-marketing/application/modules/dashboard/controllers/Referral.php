<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Referral extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole('2');
		agreement_check();
		$this->load->model(['Referral_model' => 'model']);
	}

	public function index()
	{
		$this->viewku->title("My Contacts");
		$this->viewku->view("referral/list.php");
	}

	// ################################################
	// datatables
	function fetch_list()
	{
		$fetch_data = $this->model->make_datatables_list();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {



			$sub_array = array();
			$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-left font-weight-bold">
								' . $r->nama_lengkap . '
								</div>';
			$sub_array[] =  '<div class="text-center">' . $r->email . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->no_hp . '</div>';
			$sub_array[] =  '<div class="text-left">' . $this->model->get_akun_real($r->nasabah_id) . '</div>';
			$sub_array[] =  '<div class="text-center">' . '$ 0' . '</div>';
			$sub_array[] =  '<div class="text-center"><code>' . ($r->status_verify == 'Y' ? 'Verified' : 'Unverified') . '</code></div>';
			$data[] = $sub_array;
			$no++;
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->model->get_all_data_list(),
			"recordsFiltered" => $this->model->get_filtered_data_list(),
			"data" => $data
		);
		echo json_encode($output);
	}
}
