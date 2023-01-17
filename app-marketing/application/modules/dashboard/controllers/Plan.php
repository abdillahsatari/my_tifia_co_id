<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Plan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole('2');
		agreement_check();
		$this->load->model(['Plan_model' => 'model']);
	}

	public function index()
	{
		$this->viewku->title("My Plan");
		$this->viewku->view("plan/list.php");
	}

	public function tambah()
	{
		// $marketing_id = sess('mkt');

		$main['kode'] = generate_kd(10, after_last_id('marketing_planning', 'id'));

		$this->viewku->title("Tambah Plan");
		$this->viewku->view("plan/tambah.php", $main);
	}

	public function tambah_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			$this->rules();
			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();
				$marketing_id = sess('mkt');

				// Start database transaction
				$this->db->trans_start();

				// insert marketing_planning
				$marketing_planning = [
					'marketing_id' => $marketing_id,
					'kode' => '0',
					'bulan' => $this->input->post('bulan'),
					'tahun' => $this->input->post('tahun'),
					'judul' => $this->input->post('judul'),
					'target_omset' => $this->input->post('target_omset'),
					'deskripsi' => $this->input->post('deskripsi'),
					'minggu_1' => $this->input->post('minggu_1'),
					'minggu_2' => $this->input->post('minggu_2'),
					'minggu_3' => $this->input->post('minggu_3'),
					'minggu_4' => $this->input->post('minggu_4'),
					'date_added' => $date,
					'is_deleted' => '0'
				];
				$this->db->insert('marketing_planning', $marketing_planning);
				$id_marketing_planning = $this->db->insert_id();

				$kode = 'SPL-' . generate_kd(10, $id_marketing_planning);
				$this->db->update('marketing_planning', ['kode' => $kode], ['id' => $id_marketing_planning]);

				// insert log
				$marketing_log = [
					'marketing_id' => $marketing_id,
					'summary' => "marketing_planning[$id_marketing_planning]",
					'tipe' => 'tambah plan',
					'aktifitas' => 'Tambah Plan: [' . $kode . ']',
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Tambah plan gagal';
				} else {
					$json['success'] = true;
					$json['alert'] = 'Tambah plan berhasil';
					$json['href'] = base_url() . 'dashboard/plan';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	// Edit

	public function view($kode)
	{

		$marketing_id = sess('mkt');
		$marketing_planning = $this->db->query("SELECT * FROM marketing_planning WHERE kode='$kode' AND marketing_id='$marketing_id'");

		if ($marketing_planning->num_rows() > 0) {
			$main['plan'] = $marketing_planning->row_array();
			$this->viewku->title("Plan " . $kode);
			$this->viewku->view("plan/edit.php", $main);
		}
	}

	public function edit_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			$this->rules();
			$this->form_validation->set_rules('kode', 'kode', 'trim|required|xss_clean');
			$this->form_validation->set_rules('id', 'id', 'trim|required|numeric');
			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();
				$marketing_id = sess('mkt');
				$id = $this->input->post('id');

				// Start database transaction
				$this->db->trans_start();

				// insert marketing_planning
				$marketing_planning = [
					'bulan' => $this->input->post('bulan'),
					'tahun' => $this->input->post('tahun'),
					'judul' => $this->input->post('judul'),
					'target_omset' => $this->input->post('target_omset'),
					'deskripsi' => $this->input->post('deskripsi'),
					'minggu_1' => $this->input->post('minggu_1'),
					'minggu_2' => $this->input->post('minggu_2'),
					'minggu_3' => $this->input->post('minggu_3'),
					'minggu_4' => $this->input->post('minggu_4'),
					'date_updated' => $date,
					// 'is_deleted' => '0'
				];
				$this->db->update('marketing_planning', $marketing_planning, ['id' => $id]);

				// insert log
				$marketing_log = [
					'marketing_id' => $marketing_id,
					'summary' => "marketing_planning[$id]",
					'tipe' => 'edit plan',
					'aktifitas' => 'Edit Plan: [' . $this->input->post('kode') . ']',
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Edit plan gagal';
				} else {
					$json['success'] = true;
					$json['alert'] = 'Edit plan berhasil';
					// $json['href'] = base_url() . 'dashboard/plan';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}


	private function rules()
	{
		// $this->form_validation->set_rules('kode', 'kode', 'trim|required|numeric');
		$this->form_validation->set_rules('bulan', 'bulan', 'trim|required|numeric');
		$this->form_validation->set_rules('tahun', 'tahun', 'trim|required|numeric');
		$this->form_validation->set_rules('judul', 'judul', 'trim|required|xss_clean');
		$this->form_validation->set_rules('target_omset', 'target omset', 'trim|required|numeric');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|xss_clean');
		$this->form_validation->set_rules('minggu_1', 'minggu_1', 'trim|xss_clean');
		$this->form_validation->set_rules('minggu_2', 'minggu_2', 'trim|xss_clean');
		$this->form_validation->set_rules('minggu_3', 'minggu_3', 'trim|xss_clean');
		$this->form_validation->set_rules('minggu_4', 'minggu_4', 'trim|xss_clean');
	}


	// ################################################
	// datatables
	function fetch_plan()
	{
		$fetch_data = $this->model->make_datatables_plan();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			$sub_array = array();
			// $sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-center">' . '<b class="text-danger">' . $r->kode . '</b></div>';
			$sub_array[] =  '<div class="text-center">' . date('F', mktime(0, 0, 0, $r->bulan, 10)) . ' ' . $r->tahun . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->judul . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->target_omset . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->deskripsi . '</div>';
			$sub_array[] =  '<div class="text-center">
								<div class="btn-group">
									<a href="' . base_url('dashboard/plan/view/' . $r->kode) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
								</div>
							</div>';
			$data[] = $sub_array;
			$no++;
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
