<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model(['sales/Nasabah_model' => 'model']);
		$this->load->library('Tree');
	}

	public function index()
	{
		$data['title'] = 'Kontak / Calon nasabah';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Marketing' => '#',
			'Calon nasabah' => '#',
		];
		$data['page'] = 'admin_marketing/nasabah/index';
		$this->load->view('template/backend', $data);
	}

	public function view($kode)
	{
		$calon_nasabah = $this->db->query("SELECT * FROM calon_nasabah WHERE kode='$kode'");

		if ($calon_nasabah->num_rows() > 0) {

			$data['nasabah'] = $calon_nasabah->row_array();

			$data['title'] = 'Kontak / Calon nasabah';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Marketing' => '#',
				'Calon nasabah' => '#',
				$kode => '#',
			];
			$data['page'] = 'admin_marketing/nasabah/view';
			$this->load->view('template/backend', $data);
		}
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "calon nasabah.xls";
		$judul = "calon nasabah";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Calon Nasabah");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Calon Nasabah");
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Marketing");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Marketing");
		xlsWriteLabel($tablehead, $kolomhead++, "Email");
		xlsWriteLabel($tablehead, $kolomhead++, "No. HP");
		xlsWriteLabel($tablehead, $kolomhead++, "No. Telp");
		xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
		xlsWriteLabel($tablehead, $kolomhead++, "Pekerjaan");
		xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
		xlsWriteLabel($tablehead, $kolomhead++, "Provinsi");
		xlsWriteLabel($tablehead, $kolomhead++, "Kabupaten");
		xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
		xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
		xlsWriteLabel($tablehead, $kolomhead++, "Prioritas");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal ditambahkan");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal diperbarui");

		foreach ($this->model->get_all() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode_sales);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_sales);
			xlsWriteLabel($tablebody, $kolombody++, $data->email);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_telp);
			xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
			xlsWriteLabel($tablebody, $kolombody++, $data->pekerjaan);
			xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
			xlsWriteLabel($tablebody, $kolombody++, $data->provinsi);
			xlsWriteLabel($tablebody, $kolombody++, $data->kabupaten);
			xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
			xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
			xlsWriteLabel($tablebody, $kolombody++, $data->prioritas);
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
		$fetch_data = $this->model->make_datatables_list();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			$sub_array = array();
			$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-left font-weight-bold">
								<span class="text-danger">' . $r->kode . '</span>
								<br>
								' . $r->nama . '
								</div>';
			$sub_array[] =  '<div class="text-left">
								<span class="text-danger">' . $r->kode_sales . '</span>
								<br>
								' . $r->nama_sales . '
								</div>';
			$sub_array[] =  '<div class="text-center">' . $r->no_hp . '<br>' . $r->email . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->kota_asal . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->prioritas . '</div>';
			$sub_array[] =  '<div class="text-center">
								<div class="btn-group">
									<a href="' . base_url('adminarea/marketing/nasabah/view/' . $r->kode) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
								</div>
							</div>';
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
