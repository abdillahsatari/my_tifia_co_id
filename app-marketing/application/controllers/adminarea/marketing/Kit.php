<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kit extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model(['sales/Kit_model' => 'model']);
	}

	public function index()
	{
		$this->tambah();
	}

	public function kits()
	{
		$data['tipe'] = 'kit';
		$data['title'] = 'Marketing Kit';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Kit & Education' => '#',
			'Marketing Kit' => '#',
		];
		$data['page'] = 'admin_marketing/kit/list';
		$this->load->view('template/backend', $data);
	}

	public function educations()
	{
		$data['tipe'] = 'edukasi';
		$data['title'] = 'Education';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Kit & Education' => '#',
			'Educations' => '#',
		];
		$data['page'] = 'admin_marketing/kit/list';
		$this->load->view('template/backend', $data);
	}

	public function tambah()
	{
		$data['title'] = 'Tambah Kit & Education';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Kit & Education' => '#',
			'Tambah' => '#',
		];
		$data['page'] = 'admin_marketing/kit/tambah';
		$this->load->view('template/backend', $data);
	}

	public function tambah_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => []];

			$this->_rules();
			if ($this->form_validation->run()) {
				$json['form_validation'] = true;

				// Start database transaction
				$this->db->trans_begin();

				$date = new_date();

				$data = [
					'nama' => $this->input->post('nama'),
					'deskripsi' => $this->input->post('deskripsi'),
					'tipe' => $this->input->post('tipe'),
					'jenis' => $this->input->post('jenis'),
					'date_added' => $date,
				];
				$this->db->insert('marketing_kit', $data);
				$id = $this->db->insert_id();


				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					$json['alert'] = 'Tambah gagal';
				} else {

					$this->load->helper('upload_image');
					$do_upload = upload_image('file', './uploads/marketing-kit', $this->input->post('tipe') . '_', 'jpg|jpeg|png|pdf|gif|mp4', 1024 * 100);

					if ($do_upload['is_success'] == TRUE) {
						$this->db->trans_commit();

						$this->db->update('marketing_kit', ['file' => $do_upload['file_name']], ['id' => $id]);

						$json['success'] = true;
						$json['alert'] = 'Tambah berhasil';
						$json['href'] = base_url('adminarea/marketing/kit/view/' . $id);
					} else {
						$this->db->trans_rollback();
						$json['alert'] = $do_upload['msg'];
					}
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	public function view($id)
	{
		$result = $this->db->query("SELECT * FROM marketing_kit WHERE id='$id'")->row_array();
		if ($result) {

			$data['data'] = $result;

			$data['title'] = 'View Kit & Education';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Kit & Education' => '#',
				'View' => '#',
			];
			$data['page'] = 'admin_marketing/kit/view';
			$this->load->view('template/backend', $data);
		}
	}

	public function delete($id)
	{
		$result = $this->db->query("SELECT * FROM marketing_kit WHERE id='$id'")->row_array();
		if ($result) {

			// hapus file
			if ($result['file'] != '' && $result['file'] != null) {
				$path = 'uploads/marketing-kit/' .  $result['file'];
				if (file_exists($path)) {
					unlink($path);
				}
			}

			$this->db->delete('marketing_kit', ['id' => $id]);

			flash_alert('Berhasil hapus', 'success');
			redirect('adminarea/marketing/kit/' . ($result['tipe'] == 'kit' ? 'kits' : 'educations'));
		} else {
			redirect('adminarea/marketing/kit/');
		}
	}

	public function update_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => []];

			$this->form_validation->set_rules('id', 'id', 'trim|required|numeric');
			$this->_rules();
			if ($this->form_validation->run()) {
				$json['form_validation'] = true;

				// Start database transaction
				$this->db->trans_begin();

				$id = $this->input->post('id');

				$result = $this->db->query("SELECT * FROM marketing_kit WHERE id='$id'")->row_array();

				if ($result) {

					$date = new_date();

					$data = [
						'nama' => $this->input->post('nama'),
						'deskripsi' => $this->input->post('deskripsi'),
						'tipe' => $this->input->post('tipe'),
						'jenis' => $this->input->post('jenis'),
						'date_updated' => $date,
					];
					$this->db->update('marketing_kit', $data, ['id' => $id]);

					if ($this->db->trans_status() === FALSE) {
						$this->db->trans_rollback();
						$json['alert'] = 'Edit gagal';
					} else {

						if ($_FILES['file']['name'] != NULL) {

							$this->load->helper('upload_image');
							$do_upload = upload_image('file', './uploads/marketing-kit',  $this->input->post('tipe') . '_', 'jpg|jpeg|png|pdf|gif|mp4', 1024 * 5);

							if ($do_upload['is_success'] == TRUE) {
								$this->db->trans_commit();

								// hapus gambar lama jika ada
								if ($result['file'] != '' && $result['file'] != null) {
									$path = 'uploads/marketing-kit/' .  $result['file'];
									if (file_exists($path)) {
										unlink($path);
									}
								}

								$this->db->update('marketing_kit', ['file' => $do_upload['file_name']], ['id' => $id]);

								$json['success'] = true;
								$json['alert'] = 'Edit berhasil';
								$json['href'] = base_url('adminarea/marketing/kit/view/' . $id);
							} else {
								$this->db->trans_rollback();
								$json['alert'] = $do_upload['msg'];
							}
						} else {
							$this->db->trans_commit();

							$json['success'] = true;
							$json['alert'] = 'Edit berhasil';
							$json['href'] = base_url('adminarea/marketing/kit/view/' . $id);
						}
					}
				} else {
					$json['alert'] = 'Data tidak ditemukan';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	private function _rules()
	{
		$this->form_validation->set_rules('nama', 'judul', 'trim|required|xss_clean');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|xss_clean');
		$this->form_validation->set_rules('tipe', 'tipe', 'trim|required|xss_clean');
		$this->form_validation->set_rules('jenis', 'jenis', 'trim|required|xss_clean');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
	}

	private function get_kit($jenis = '')
	{
		return $this->db->query("SELECT * FROM marketing_kit WHERE jenis='$jenis' AND tipe='kit'")->result();
	}

	// ################################################
	// datatables
	function fetch_list($tipe = 'kit')
	{
		$fetch_data = $this->model->make_datatables_list($tipe);
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			$sub_array = array();
			$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-left">' . $r->nama . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->jenis . '</div>';
			$sub_array[] =  '<div class="text-center">' . ucfirst($r->tipe) . '</div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->date_added) . '</div>';
			$sub_array[] =  '<div class="text-center">
								<div class="btn-group">
									<a href="' . base_url('adminarea/marketing/kit/view/' . $r->id) . '" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
									<a href="' . base_url('uploads/marketing-kit/' . $r->file) . '" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-download"></i></a>
								</div>
							</div>';
			$data[] = $sub_array;
			$no++;
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->model->get_all_data_list($tipe),
			"recordsFiltered" => $this->model->get_filtered_data_list($tipe),
			"data" => $data
		);
		echo json_encode($output);
	}
}
