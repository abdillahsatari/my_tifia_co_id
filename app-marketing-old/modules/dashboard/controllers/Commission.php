<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Commission extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole('2');
		agreement_check();
		$this->load->library('Tree');
		$this->load->model(['Commission_model' => 'model']);
	}

	public function index()
	{
		$this->viewku->title("My Commission");
		$this->viewku->view("commission/komisi_saya.php");
	}


	public function team()
	{
		$this->viewku->title("Team Commission");
		$this->viewku->view("commission/komisi_team.php");
	}



	// ################################################
	// datatables
	function fetch_list()
	{
		$fetch_data = $this->model->make_datatables_list();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			// check apakah nasabah saya
			$cek = $this->model->apakah_nasabah_saya($r->nasabah_id, sess('mkt'));
			if ($cek == TRUE)
				$desc = 'Direct Commission Lot';
			else
				$desc = 'Overriding';

			$sub_array = array();
			$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-left">' . ucwords($r->nama_lengkap) . '</div>';
			$sub_array[] =  '<div class="text-center"><code>' . $desc . '</code></div>';
			$sub_array[] =  '<div class="text-center">IDR ' . rupiah($r->amount) . '</div>';
			$sub_array[] =  '<div class="text-center">USD ' . rupiah($r->amount_usd) . '</div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->date) . '</div>';
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

	function fetch_teamCommission()
	{
		$fetch_data = $this->model->make_datatables_teamCommission();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			// check apakah nasabah mitra
			$cek = $this->model->apakah_nasabah_saya($r->nasabah_id, $r->marketing_id);
			if ($cek == TRUE)
				$desc = 'Direct Commission Lot';
			else
				$desc = 'Overriding';

			$sub_array = array();
			$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-left">
								<span class="text-danger">' . $r->kode_sales . '</span>
								<br>
								' . $r->nama_sales . '
							</div>';
			$sub_array[] =  '<div class="text-left">' . ucwords($r->nama_lengkap) . '</div>';
			$sub_array[] =  '<div class="text-center"><code>' . $desc . '</code></div>';
			$sub_array[] =  '<div class="text-center">IDR ' . rupiah($r->amount) . '</div>';
			$sub_array[] =  '<div class="text-center">USD ' . rupiah($r->amount_usd) . '</div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->date) . '</div>';
			$data[] = $sub_array;
			$no++;
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->model->get_all_data_teamCommission(),
			"recordsFiltered" => $this->model->get_filtered_data_teamCommission(),
			"data" => $data
		);
		echo json_encode($output);
	}
}
