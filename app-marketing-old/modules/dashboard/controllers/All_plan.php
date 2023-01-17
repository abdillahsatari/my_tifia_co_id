<?php

defined('BASEPATH') or exit('No direct script access allowed');

class All_plan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole(['8', '9', '7']);
		agreement_check();
		$this->load->library(['tree']);
		$this->load->model(['all_plan_model' => 'model']);
	}

	public function index()
	{
		$this->viewku->title("List Perencanaan");
		$this->viewku->view("for_dm/plan/index");
	}

	public function view($kode)
	{
		$marketing_planning = $this->db->query("SELECT marketing_planning.*, (SELECT nama FROM marketing WHERE marketing.id=marketing_planning.marketing_id) as nama_sales FROM marketing_planning WHERE kode='$kode'");

		if ($marketing_planning->num_rows() > 0) {
			$data['plan'] = $marketing_planning->row_array();

			$this->viewku->title("List Perencanaan");
			$this->viewku->view("for_dm/plan/view", $data);
		}
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "perencanaan.xls";
		$judul = "perencanaan";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Marketing");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Marketing");
		xlsWriteLabel($tablehead, $kolomhead++, "Bulan (Periode)");
		xlsWriteLabel($tablehead, $kolomhead++, "Tahun (Periode)");
		xlsWriteLabel($tablehead, $kolomhead++, "Judul");
		xlsWriteLabel($tablehead, $kolomhead++, "Target Omset");
		xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
		xlsWriteLabel($tablehead, $kolomhead++, "Minggu 1");
		xlsWriteLabel($tablehead, $kolomhead++, "Minggu 2");
		xlsWriteLabel($tablehead, $kolomhead++, "Minggu 3");
		xlsWriteLabel($tablehead, $kolomhead++, "Minggu 4");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal ditambahkan");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal diperbarui");

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
				xlsWriteLabel($tablebody, $kolombody++, $data->bulan);
				xlsWriteLabel($tablebody, $kolombody++, $data->tahun);
				xlsWriteLabel($tablebody, $kolombody++, $data->judul);
				xlsWriteNumber($tablebody, $kolombody++, $data->target_omset);
				xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);
				xlsWriteLabel($tablebody, $kolombody++, $data->minggu_1);
				xlsWriteLabel($tablebody, $kolombody++, $data->minggu_2);
				xlsWriteLabel($tablebody, $kolombody++, $data->minggu_3);
				xlsWriteLabel($tablebody, $kolombody++, $data->minggu_4);
				xlsWriteLabel($tablebody, $kolombody++, $data->date_added);
				xlsWriteLabel($tablebody, $kolombody++, $data->date_updated);

				$tablebody++;
				$nourut++;
			}
		}



		xlsEOF();
		exit();
	}

	// ################################################
	// datatables
	function fetch_plan()
	{
		// get sales yg dapat user lihat
		$array_sales = $this->tree->get_all_child_id(sess('mkt'));

		$fetch_data = $this->model->make_datatables_plan();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			// cek apabila termasuk child dari user
			if (in_array($r->marketing_id, $array_sales)) {

				$sub_array = array();
				$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
				$sub_array[] =  '<div class="text-center">' . '<b class="text-danger">' . $r->kode . '</b></div>';
				$sub_array[] =  '<div class="text-left">
									<a href="' . base_url('dashboard/all_sales/view/' . $r->marketing_id) . '" class="text-danger">' . $r->kode_sales . '</a>
									<br>
									' . $r->nama_sales . '
									</div>';
				$sub_array[] =  '<div class="text-center">' . date('F', mktime(0, 0, 0, $r->bulan, 10)) . ' ' . $r->tahun . '</div>';
				$sub_array[] =  '<div class="text-center">' . $r->judul . '</div>';
				$sub_array[] =  '<div class="text-center">Rp ' . rupiah($r->target_omset) . '</div>';
				$sub_array[] =  '<div class="text-center">' . $r->deskripsi . '</div>';
				$sub_array[] =  '<div class="text-center">
									<div class="btn-group">
										<a href="' . base_url('dashboard/all_plan/view/' . $r->kode) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
									</div>
								</div>';
				$data[] = $sub_array;
				$no++;
			}
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->model->get_all_data_plan(),
			"recordsFiltered" => $this->model->get_filtered_data_plan(),
			"data" => $data
		);
		echo json_encode($output);
	}
}
