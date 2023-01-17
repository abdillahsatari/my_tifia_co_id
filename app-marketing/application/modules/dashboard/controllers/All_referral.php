<?php

defined('BASEPATH') or exit('No direct script access allowed');

class All_referral extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole(['8', '9', '7']);
		agreement_check();
		$this->load->library(['tree']);
		$this->load->model(['all_referral_model' => 'model']);
	}

	public function index()
	{
		$this->viewku->title("List Referral");
		$this->viewku->view("for_dm/referral/index");
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "maketing referral.xls";
		$judul = "maketing referral";
		$tablehead = 0;
		$tablebody = 1;
		$nourut = 1;
		//penulisan header
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=" . $namaFile . "");
		header("Content-Transfer-Encoding: binary ");

		xlsBOF();

		$kolomhead = 0;
		xlsWriteLabel($tablehead, $kolomhead++, "No");
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Merketing");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Merketing");
		xlsWriteLabel($tablehead, $kolomhead++, "Nasabah");
		xlsWriteLabel($tablehead, $kolomhead++, "Email");
		xlsWriteLabel($tablehead, $kolomhead++, "No. HP");
		xlsWriteLabel($tablehead, $kolomhead++, "Akun Perdagangan");
		xlsWriteLabel($tablehead, $kolomhead++, "Balance");
		xlsWriteLabel($tablehead, $kolomhead++, "Status Verifikasi");

		// get sales yg dapat user lihat
		$array_sales = $this->tree->get_all_child_id(sess('mkt'));

		foreach ($this->model->get_all() as $data) {

			// cek apabila termasuk child dari user
			if (in_array($data->marketing_id, $array_sales)) {

				$kolombody = 0;

				//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
				xlsWriteNumber($tablebody, $kolombody++, $nourut);
				xlsWriteLabel($tablebody, $kolombody++, $data->kode_sales);
				xlsWriteLabel($tablebody, $kolombody++, $data->nama_sales);
				xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
				xlsWriteLabel($tablebody, $kolombody++, $data->email);
				xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
				xlsWriteLabel($tablebody, $kolombody++, implode(",", $this->model->array_akun_real($data->nasabah_id)));
				xlsWriteLabel($tablebody, $kolombody++, '');
				xlsWriteLabel($tablebody, $kolombody++, ($data->status_verify == 'Y' ? 'Verified' : 'Unverified'));

				$tablebody++;
				$nourut++;
			}
		}



		xlsEOF();
		exit();
	}

	// ################################################
	// datatables
	function fetch_list()
	{
		// get sales yg dapat user lihat
		$array_sales = $this->tree->get_all_child_id(sess('mkt'));

		$fetch_data = $this->model->make_datatables_list();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			// cek apabila termasuk child dari user
			if (in_array($r->marketing_id, $array_sales)) {

				$sub_array = array();
				$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
				$sub_array[] =  '<div class="text-left">
									<a href="' . base_url('dashboard/all_sales/view/' . $r->marketing_id) . '" class="text-danger">' . $r->kode_sales . '</a>
									<br>
									' .  ($r->nama_sales != '' ? $r->nama_sales : '-') . '
									</div>';
				$sub_array[] =  '<div class="text-left">
									' .  $r->nama_lengkap . '
									</div>';
				$sub_array[] =  '<div class="text-center">' . $r->email . '</div>';
				$sub_array[] =  '<div class="text-center">' . $r->no_hp . '</div>';
				$sub_array[] =  '<div class="text-left">' . $this->model->get_akun_real($r->nasabah_id) . '</div>';
				$sub_array[] =  '<div class="text-center">' . '$ 0' . '</div>';
				$sub_array[] =  '<div class="text-center"><code>' . ($r->status_verify == 'Y' ? 'Verified' : 'Unverified') . '</code></div>';
				$data[] = $sub_array;
				$no++;
			}
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
