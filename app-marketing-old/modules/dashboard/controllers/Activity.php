<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Activity extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole('2');
		agreement_check();
		$this->load->model(['Activity_model' => 'model']);
	}

	public function index()
	{
		$this->activity();
	}

	// ACTIVITY

	public function activity()
	{
		$this->viewku->title("My Activity");
		$this->viewku->view("activity/list.php");
	}

	public function view($kode)
	{
		$marketing_id = sess('mkt');

		$marketing_activity = $this->db->query("SELECT * FROM marketing_activity WHERE kode='$kode' AND marketing_id='$marketing_id'");

		if ($marketing_activity->num_rows() > 0) {

			$main['activity'] = $marketing_activity->row_array();
			$main['calon_nasabah'] =  $this->model->nasabah_by_marketingID($main['activity']['marketing_id']);

			$this->viewku->title("Activity " . $kode);
			$this->viewku->view("activity/edit.php", $main);
		}
	}


	public function tambah()
	{
		$marketing_id = sess('mkt');

		$main['kode'] = generate_kd(6, after_last_id('calon_nasabah', 'id'));
		$main['calon_nasabah'] =  $this->model->nasabah_by_marketingID($marketing_id);


		$this->viewku->title("Tambah Activity");
		$this->viewku->view("activity/tambah.php", $main);
	}

	public function tambah_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			// $this->form_validation->set_rules('kode', 'kode', 'trim|required|numeric');
			$this->rules();
			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();

				$marketing_id = sess('mkt');

				// Start database transaction
				$this->db->trans_start();

				// insert marketing_activity
				$marketing_activity = [
					'marketing_id' => $marketing_id,
					'kode' => '0',
					'prioritas' => $this->input->post('prioritas'),
					'kategori' => $this->input->post('kategori'),
					'calon_nasabah_id' => $this->input->post('nasabah'),
					'deskripsi' => $this->input->post('deskripsi'),
					'date_added' => $date,
					'is_deleted' => '0'
				];
				$this->db->insert('marketing_activity', $marketing_activity);
				$id_marketing_activity = $this->db->insert_id();

				$kode = 'ACT-' . generate_kd(10, $id_marketing_activity);
				$this->db->update('marketing_activity', ['kode' => $kode], ['id' => $id_marketing_activity]);

				// insert log
				$marketing_log = [
					'marketing_id' => $marketing_id,
					'summary' => "marketing_activity[$id_marketing_activity]",
					'tipe' => 'tambah activity',
					'aktifitas' => 'Tambah Activity: ' . $this->input->post('kategori') . ' [' . $kode . ']',
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Tambah activity gagal';
				} else {
					$json['success'] = true;
					$json['alert'] = 'Tambah activity berhasil';
					$json['href'] = base_url() . 'dashboard/activity';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	public function edit_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			// $this->form_validation->set_rules('kode', 'kode', 'trim|required|numeric');
			$this->form_validation->set_rules('id', 'id', 'trim|required|numeric');
			$this->rules();
			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();

				$marketing_id = sess('mkt');
				$id_marketing_activity = $this->input->post('id');
				$kode = $this->input->post('kode');

				// Start database transaction
				$this->db->trans_start();

				// marketing_activity
				$marketing_activity = [
					'prioritas' => $this->input->post('prioritas'),
					'kategori' => $this->input->post('kategori'),
					'calon_nasabah_id' => $this->input->post('nasabah'),
					'deskripsi' => $this->input->post('deskripsi'),
					'date_updated' => $date,
					// 'is_deleted' => '0'
				];
				$this->db->update('marketing_activity', $marketing_activity, ['id' => $id_marketing_activity]);

				// insert log
				$marketing_log = [
					'marketing_id' => $marketing_id,
					'summary' => "marketing_activity[$id_marketing_activity]",
					'tipe' => 'edit activity',
					'aktifitas' => 'Edit Activity: [' . $kode . ']',
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Edit activity gagal';
				} else {
					$json['success'] = true;
					$json['alert'] = 'Edit activity berhasil';
					$json['href'] = base_url() . 'dashboard/activity';
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

		$this->form_validation->set_rules('prioritas', 'prioritas', 'trim|required|in_list[Hot prospek,Reguler]');
		$this->form_validation->set_rules('kategori', 'kategori', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nasabah', 'nasabah', 'trim|required|numeric');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required|xss_clean');
	}


	// ################################################
	// datatables
	function fetch_activity()
	{
		$fetch_data = $this->model->make_datatables_activity();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			$sub_array = array();
			// $sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-center">' . '<b class="text-danger">' . $r->kode . '</b></div>';
			$sub_array[] =  '<div class="text-center">' . $r->nama . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->prioritas . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->kategori . '</div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->date_added, 'd/m/Y') . '</div>';
			$sub_array[] =  '<div class="text-center">
								<div class="btn-group">
									<a href="' . base_url('dashboard/activity/view/' . $r->kode) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
								</div>
							</div>';
			$data[] = $sub_array;
			$no++;
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
