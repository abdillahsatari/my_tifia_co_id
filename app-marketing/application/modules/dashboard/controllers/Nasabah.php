<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole('2');
		agreement_check();
		$this->load->model(['Nasabah_model' => 'model']);
	}

	public function index()
	{
		$this->viewku->title("My Nasabah");
		$this->viewku->view("nasabah/list.php");
	}

	public function view($kode)
	{

		$marketing_id = sess('mkt');
		$calon_nasabah = $this->db->query("SELECT * FROM calon_nasabah WHERE kode='$kode' AND marketing_id='$marketing_id'");

		if ($calon_nasabah->num_rows() > 0) {

			$main['nasabah'] = $calon_nasabah->row_array();

			$this->viewku->title("Nasabah " . $kode);
			$this->viewku->view("nasabah/calon_edit.php", $main);
		}
	}

	public function tambah()
	{
		$main['kode'] = generate_kd(10, after_last_id('calon_nasabah', 'id'));
		$this->viewku->title("Tambah Nasabah");
		$this->viewku->view("nasabah/calon_tambah.php", $main);
	}

	public function tambah_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			// $this->form_validation->set_rules('kode', 'kode', 'trim|required|numeric');
			$this->form_validation->set_rules('nama', 'nama', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'email', 'trim|valid_email');
			$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required|numeric');
			$this->form_validation->set_rules('no_telp', 'no telp', 'trim|numeric');
			$this->form_validation->set_rules('jk', 'jenis kelamin', 'trim|required|in_list[P,L]', ['in_list' => 'Pilih salah satu Pria atau Wanita']);
			$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('alamat', 'alamat', 'trim|required|xss_clean');
			$this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required|numeric', ['numeric' => '{field} salah']);
			$this->form_validation->set_rules('kabupaten', 'kabupaten', 'trim|required|numeric', ['numeric' => '{field} salah']);
			$this->form_validation->set_rules('kecamatan', 'kecamatan', 'trim|required|numeric', ['numeric' => '{field} salah']);
			$this->form_validation->set_rules('kelurahan', 'kelurahan', 'trim|required|numeric', ['numeric' => '{field} salah']);
			$this->form_validation->set_rules('prioritas', 'prioritas', 'trim|required|xss_clean');

			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();

				$marketing_id = sess('mkt');

				// Start database transaction
				$this->db->trans_start();

				// insert calon nasabah
				$calon_nasabah = [
					'marketing_id' => $marketing_id,
					'kode' => '0',
					'nama' => $this->input->post('nama'),
					'email' => ($this->input->post('email') != '' ? $this->input->post('email') : ''),
					'no_hp' => $this->input->post('no_hp'),
					'no_telp' => $this->input->post('no_telp'),
					'jenis_kelamin' => $this->input->post('jk'),
					'pekerjaan' => $this->input->post('pekerjaan'),
					'alamat' => $this->input->post('alamat'),
					'id_provinsi' => $this->input->post('provinsi'),
					'id_kabupaten' => $this->input->post('kabupaten'),
					'id_kecamatan' => $this->input->post('kecamatan'),
					'id_kelurahan' => $this->input->post('kelurahan'),
					'prioritas' => $this->input->post('prioritas'),
					'date_added' => $date,
					'is_deleted' => '0'
				];
				$this->db->insert('calon_nasabah', $calon_nasabah);
				$id_calon_nasabah = $this->db->insert_id();

				$kode = 'CNSB-' . generate_kd(6, $id_calon_nasabah);
				$this->db->update('calon_nasabah', ['kode' => $kode], ['id' => $id_calon_nasabah]);

				// insert log
				$marketing_log = [
					'marketing_id' => $marketing_id,
					'summary' => "calon_nasabah[$id_calon_nasabah]",
					'tipe' => 'tambah calon nasabah',
					'aktifitas' => 'Tambah calon nasabah [' . $kode . ']',
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Tambah contact gagal';
				} else {
					$json['success'] = true;
					$json['alert'] = 'Tambah contact berhasil';
					$json['href'] = base_url() . 'dashboard';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	public function semuaTransaksi()
	{
		$this->viewku->title("Semua Transaksi");
		$this->viewku->view("nasabah/list_semua_transaksi");
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
			// $sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-left font-weight-bold">
								<span class="text-danger">' . $r->kode . '</span>
								<br>
								' . $r->nama . '
								</div>';
			$sub_array[] =  '<div class="text-center">' . $r->no_hp . '<br>' . $r->email . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->kota_asal . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->prioritas . '</div>';
			$sub_array[] =  '<div class="text-center">
								<div class="btn-group">
									<a href="' . base_url('dashboard/nasabah/view/' . $r->kode) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
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

	function fetch_semua_transaksi()
	{
		$fetch_data = $this->model->make_datatables_semua_transaksi();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			$sub_array = array();
			// $sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-left font-weight-bold">
								<span class="text-danger">' . $r->kode . '</span>
								<br>
								' . $r->nama . '
								</div>';
			$sub_array[] =  '<div class="text-center">' . $r->no_hp . '<br>' . $r->email . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->kota_asal . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->prioritas . '</div>';
			$sub_array[] =  '<div class="text-center">
								<div class="btn-group">
									<a href="' . base_url('dashboard/nasabah/view/' . $r->kode) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
								</div>
							</div>';
			$data[] = $sub_array;
			$no++;
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->model->get_all_data_semua_transaksi(),
			"recordsFiltered" => $this->model->get_filtered_data_semua_transaksi(),
			"data" => $data
		);
		echo json_encode($output);
	}
}
