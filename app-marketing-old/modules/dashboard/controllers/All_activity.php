<?php

defined('BASEPATH') or exit('No direct script access allowed');

class All_activity extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole(['8', '9', '7']);
		agreement_check();
		$this->load->library(['tree']);
		$this->load->model(['All_activity_model' => 'model']);
	}

	public function index()
	{
		$this->activity();
	}

	// ACTIVITY

	public function activity()
	{
		$this->viewku->title("List Activity");
		$this->viewku->view("for_dm/activity/index");
	}

	public function view($kode)
	{
		$marketing_activity = $this->db->query("SELECT * FROM marketing_activity WHERE kode='$kode'");

		if ($marketing_activity->num_rows() > 0) {

			$data['activity'] = $marketing_activity->row_array();
			$data['calon_nasabah'] =  $this->model->nasabah_by_marketingID($data['activity']['marketing_id']);
			$data['sales'] =  $this->model->marketing_by_id($data['activity']['marketing_id'], 'nama, kode');

			$this->viewku->title("List Kontak / Calon nasabah");
			$this->viewku->view("for_dm/activity/view", $data);
		}
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "aktifitas.xls";
		$judul = "aktifitas";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Aktifitas");
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Marketing");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Marketing");
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Calon Nasabah");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Calon Nasabah");
		xlsWriteLabel($tablehead, $kolomhead++, "Prioritas");
		xlsWriteLabel($tablehead, $kolomhead++, "Kategori");
		xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Dibuat");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Terakhir Diperbarui");

		// get sales yg dapat user lihat
		$array_sales = $this->tree->get_all_child_id(sess('mkt'));

		foreach ($this->model->get_all() as $data) {

			// cek apabila termasuk child dari user
			if (in_array($data->marketing_id, $array_sales)) {

				$kolombody = 0;

				//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
				xlsWriteNumber($tablebody, $kolombody++, $nourut);
				xlsWriteLabel($tablebody, $kolombody++, $data->kode);
				xlsWriteLabel($tablebody, $kolombody++, $data->kode_sales);
				xlsWriteLabel($tablebody, $kolombody++, $data->nama_sales);
				xlsWriteLabel($tablebody, $kolombody++, $data->kode_nasabah);
				xlsWriteLabel($tablebody, $kolombody++, $data->nama);
				xlsWriteLabel($tablebody, $kolombody++, $data->prioritas);
				xlsWriteLabel($tablebody, $kolombody++, $data->kategori);
				xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);
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
	function fetch_activity()
	{
		// get sales yg dapat user lihat
		$array_sales = $this->tree->get_all_child_id(sess('mkt'));

		$fetch_data = $this->model->make_datatables_activity();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			// cek apabila termasuk child dari user
			if (in_array($r->marketing_id, $array_sales)) {

				$sub_array = array();
				$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
				$sub_array[] =  '<div class="text-center">' . '<b class="text-danger">' . $r->kode . '</b></div>';
				$sub_array[] =  '<div class="text-left font-weight-bold">
									<a href="' . base_url('dashboard/all_sales/view/' . $r->marketing_id) . '" class="text-danger">' . $r->kode_sales . '</a>
									<br>
									' . $r->nama_sales . '
									</div>';
				$sub_array[] =  '<div class="text-left font-weight-bold">
									<a href="' . base_url('dashboard/all_nasabah/view/' . $r->kode_nasabah) . '" class="text-danger">' . $r->kode_nasabah . '</a>
									<br>
									' . $r->nama . '
									</div>';
				$sub_array[] =  '<div class="text-center">' . $r->prioritas . '</div>';
				$sub_array[] =  '<div class="text-center">' . $r->kategori . '</div>';
				$sub_array[] =  '<div class="text-center">' . date_tampil($r->date_added, 'd/m/Y') . '</div>';
				$sub_array[] =  '<div class="text-center">
									<div class="btn-group">
										<a href="' . base_url('dashboard/all_activity/view/' . $r->kode) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
									</div>
								</div>';
				$data[] = $sub_array;
				$no++;
			}
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->model->get_all_data_activity(),
			"recordsFiltered" => $this->model->get_filtered_data_activity(),
			"data" => $data
		);
		echo json_encode($output);
	}
}
