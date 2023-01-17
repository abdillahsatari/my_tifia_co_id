<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Nmi_processed extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model(['sales/Nmi_model' => 'model']);
	}

	public function index()
	{
		$data['title'] = 'NMI Processed';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Marketing' => '#',
			'NMI' => '#',
			'NMI Processed' => '#',
		];
		$data['page'] = 'admin_marketing/nmi/processed';
		$this->load->view('template/backend', $data);
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

		foreach ($this->model->get_all() as $data) {
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



		xlsEOF();
		exit();
	}

	// ################################################
	// datatables
	function fetch_list()
	{

		$status = ['Approved', 'Declined'];

		$fetch_data = $this->model->make_datatables_list($status);
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			$sub_array = array();
			$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->date_confirmed) . '</div>';
			$sub_array[] =  '<div class="text-center">' . '<b class="text-danger">' . $r->kode . '</b></div>';
			$sub_array[] =  '<div class="text-left">
								<a href="' . base_url('adminarea/marketing/sales/view/' . $r->marketing_id) . '" class="text-danger">' . $r->kode_sales . '</a>
								<br>
								' . $r->nama_sales . '
								</div>';
			$sub_array[] =  '<div class="text-center">' . rupiah($r->grand_total) . '</div>';
			$sub_array[] =  '<div class="text-center"><code>' . $r->status . '</code></div>';
			$sub_array[] =  '<div class="text-center">
								<div class="btn-group">
									<a href="' . base_url('adminarea/marketing/nmi_request/view/' . $r->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a></div>
							</div>';
			$data[] = $sub_array;
			$no++;
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->model->get_all_data_list($status),
			"recordsFiltered" => $this->model->get_filtered_data_list($status),
			"data" => $data
		);
		echo json_encode($output);
	}
}
