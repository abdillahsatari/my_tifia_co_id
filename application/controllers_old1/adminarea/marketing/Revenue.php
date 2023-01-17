<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Revenue extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model(['sales/Revenue_model' => 'model']);
		$this->load->library('Tree');
	}

	public function index()
	{
		$this->komisi();
	}

	public function komisi()
	{
		$data['title'] = 'Komisi';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Revenue' => '#',
			'Komisi' => '#',
		];
		$data['page'] = 'admin_marketing/revenue/komisi_list';
		$this->load->view('template/backend', $data);
	}



	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "Semua Komisi (" . date('Y m d') . ").xls";
		$judul = "Semua Komisi (" . date('Y m d') . ")";
		$tablehead = 0;
		$tablebody = 1;
		$nourut = 1;
		// penulisan header
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
		xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Nasabah");
		xlsWriteLabel($tablehead, $kolomhead++, "No. Akun Perdagangan Nasabah");
		xlsWriteLabel($tablehead, $kolomhead++, "Amount USD");
		xlsWriteLabel($tablehead, $kolomhead++, "Amount IDR");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");

		foreach ($this->model->get_all() as $data) {
			$kolombody = 0;

			// ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode_sales);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama);
			xlsWriteLabel($tablebody, $kolombody++, $data->jabatan);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_nasabah);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_akun);
			xlsWriteNumber($tablebody, $kolombody++, $data->amount_usd);
			xlsWriteNumber($tablebody, $kolombody++, $data->amount);
			xlsWriteLabel($tablebody, $kolombody++, $data->date);

			// echo $data->kode_sales . ' | ';
			// echo $data->nama . ' | ';
			// echo $data->jabatan . ' | ';
			// echo $data->no_akun . ' | ';
			// echo $data->nama_nasabah . ' | ';
			// echo $data->amount_usd . ' | ';
			// echo $data->amount . ' | ';
			// echo $data->date . ' | ';
			// echo '<br>';

			$tablebody++;
			$nourut++;
		}

		xlsEOF();
		exit();
	}

	// ################################################
	// datatables
	function fetch_komisi()
	{
		$fetch_data = $this->model->make_datatables_komisi();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			$sub_array = array();
			$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-left">
                                <a href="' . base_url('adminarea/marketing/sales/view/' . $r->marketing_id) . '" class="text-danger">' . $r->kode_sales . '</a>
								<br>
								' . $r->nama . '
								</div>';
			$sub_array[] =  '<div class="text-left">
                                <a class="text-danger">' . $r->no_akun . '</a>
								<br>
								' . $r->nama_nasabah . '
								</div>';
			$sub_array[] =  '<div class="text-center">USD ' . rupiah($r->amount_usd) . '</div>';
			$sub_array[] =  '<div class="text-center">IDR ' . rupiah($r->amount) . '</div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->date) . '</div>';
			$data[] = $sub_array;
			$no++;
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->model->get_all_data_komisi(),
			"recordsFiltered" => $this->model->get_filtered_data_komisi(),
			"data" => $data
		);
		echo json_encode($output);
	}
}
