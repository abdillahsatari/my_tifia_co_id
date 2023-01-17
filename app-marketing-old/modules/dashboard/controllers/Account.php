<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole('6');
		$this->load->model(['Sales_model' => 'Sales']);
	}

	public function index()
	{
		$this->profile();
	}

	# Nota Kesepakatan Kerjasama Kegiatan Pemasaran

	public function agreement()
	{
		$main['data'] = $this->db->query('SELECT marketing.*, marketing_role.role FROM marketing, marketing_role WHERE marketing.role_id=marketing_role.id AND marketing.id="' . sess('mkt') . '"')->row_array();

		if ($main['data'] && ($main['data']['status_perjanjian'] == 'Register' || $main['data']['status_perjanjian'] == 'Checking')) {

			$this->viewku->title("Dashboard");
			$this->viewku->view("account/agreement", $main);
		} else {
			redirect('dashboard');
		}
	}

	public function agreement_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => true, 'success' => false, 'alert' => array()];

			if ($this->input->post('accept') == '1') {

				$date = new_date();

				$marketing_id = sess('mkt');

				// Start database transaction
				$this->db->trans_start();

				// update
				$marketing = [
					'status_perjanjian' => 'Approved',
					'date_perjanjian' => $date
				];
				$this->db->update('marketing', $marketing, ['id' => $marketing_id]);

				// insert log
				$marketing_log = [
					'marketing_id' => $marketing_id,
					'summary' => "marketing[$marketing_id]",
					'tipe' => 'menyelesaikan perjanjian',
					'aktifitas' => 'Menyelesaikan Nota Kesepakatan Kerjasama Kegiatan Pemasaran untuk di review oleh admin',
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Gagal mengirim Nota Kesepakatan Kerjasama Kegiatan Pemasaran';
				} else {
					$json['success'] = true;
					$json['alert'] = 'Nota Kesepakatan Kerjasama Kegiatan Pemasaran telah dikirim';
					$json['href'] = base_url('dashboard');
				}
			} else {
				$json['alert'] = 'Anda harus menerima pernyataan terlebih dahulu';
			}
			echo json_encode($json);
		}
	}


	# PROFILE

	public function profile()
	{
		$main['data'] = $this->db->query('SELECT * FROM marketing WHERE id="' . sess('mkt') . '"')->row_array();

		if ($main['data']) {

			$this->viewku->title("Dashboard");
			$this->viewku->view("account/profile", $main);
		}
	}

	public function editProfile_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			$this->form_validation->set_rules('id', 'id', 'trim|required|numeric');
			// $this->form_validation->set_rules('kode', 'kode', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nama', 'nama', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
			$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required|numeric');
			$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required|xss_clean');
			$this->form_validation->set_rules('jk', 'jenis kelamin', 'trim|required|in_list[P,L]', ['in_list' => 'Pilih salah satu Pria atau Wanita']);
			$this->form_validation->set_rules('status', 'status', 'trim|required|in_list[Lajang,Menikah]', ['in_list' => 'Pilih salah satu Lajang atau Menikah']);
			$this->form_validation->set_rules('pendidikan', 'pendidikan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('alamat', 'alamat', 'trim|required|xss_clean');
			$this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required|numeric', ['numeric' => '{field} salah']);
			$this->form_validation->set_rules('kabupaten', 'kabupaten', 'trim|required|numeric', ['numeric' => '{field} salah']);
			$this->form_validation->set_rules('kecamatan', 'kecamatan', 'trim|required|numeric', ['numeric' => '{field} salah']);
			$this->form_validation->set_rules('kelurahan', 'kelurahan', 'trim|required|numeric', ['numeric' => '{field} salah']);

			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();

				$marketing_id = sess('mkt');

				// Start database transaction
				$this->db->trans_start();

				// update
				$marketing = [
					'nama' => $this->input->post('nama'),
					// 'email' => $this->input->post('email'),
					'no_hp' => $this->input->post('no_hp'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'tanggal_lahir' => $this->input->post('tanggal_lahir'),
					'jenis_kelamin' => $this->input->post('jk'),
					'status' => $this->input->post('status'),
					'pendidikan' => $this->input->post('pendidikan'),
					'alamat' => $this->input->post('alamat'),
					'id_provinsi' => $this->input->post('provinsi'),
					'id_kabupaten' => $this->input->post('kabupaten'),
					'id_kecamatan' => $this->input->post('kecamatan'),
					'id_kelurahan' => $this->input->post('kelurahan'),
					'date_updated' => $date
				];

				// jika email tidak sama dengan email lama
				$mkt = $this->db->query("SELECT email FROM marketing WHERE id='$marketing_id'")->row_array();
				if ($mkt['email'] != $this->input->post('email')) {

					// cek apakah email sudah dipakai
					$email_baru = $this->input->post('email');
					$cek = $this->db->query("SELECT id FROM marketing WHERE email='$email_baru'")->num_rows();
					if ($cek == 0) {
						$marketing['email'] = $email_baru;
					} else {
						$alrt_email = 'Email tidak tersedia.';
					}
				}

				$this->db->update('marketing', $marketing, ['id' => $marketing_id]);

				// insert log
				$marketing_log = [
					'marketing_id' => $marketing_id,
					'summary' => "marketing[$marketing_id]",
					'tipe' => 'update profile',
					'aktifitas' => 'Edit profile',
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Update profile gagal';
				} else {
					$json['success'] = true;
					$json['alert'] = 'Update profile berhasil. ' . (isset($alrt_email) ? $alrt_email : '');
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	public function upload_files()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['success' => false, 'alert' => 'Error.'];

			// $marketing_id = sess('mkt');
			$marketing_id = $this->input->post('marketing_id');

			$query = $this->db->query("SELECT * FROM marketing where id='$marketing_id'");
			if ($query->num_rows() > 0) {
				$data = $query->row_array();

				$field = $this->input->post('field');

				$date = new_date();

				$this->load->helper('upload_image');

				// syarat
				$files = [
					['nama' => 'file_foto', 'wajib' => TRUE, 'tipe' => 'jpg|jpeg|png', 'max_size' => 1024],
					['nama' => 'file_ktp', 'wajib' => TRUE, 'tipe' => 'jpg|jpeg|png', 'max_size' => 1024],
					['nama' => 'file_cv', 'wajib' => TRUE, 'tipe' => 'pdf|docx', 'max_size' => 3072],
					['nama' => 'file_ijazah', 'wajib' => FALSE, 'tipe' => 'jpg|jpeg|png|pdf', 'max_size' => 1024],
					['nama' => 'file_sertifikat_1', 'wajib' => FALSE, 'tipe' => 'jpg|jpeg|png|pdf', 'max_size' => 1024],
					['nama' => 'file_sertifikat_2', 'wajib' => FALSE, 'tipe' => 'jpg|jpeg|png|pdf', 'max_size' => 1024],
				];

				foreach ($files as $a) {
					if ($a['nama'] == $field) {
						$upload = upload_image($field, './uploads/marketing', 'MKT_', $a['tipe'], $a['max_size']);

						if ($upload['is_success'] == TRUE) {

							if ($data[$field] != '') {
								$path = 'uploads/marketing/' .  $data[$field];
								if (file_exists($path)) {
									unlink($path);
								}
							}

							$insert = [
								$field => $upload['file_name'],
								'date_updated' => $date
							];
							$this->db->update('marketing', $insert, ['id' => $marketing_id]);

							// insert log
							$marketing_log = [
								'marketing_id' => $marketing_id,
								'summary' => "marketing[$marketing_id]",
								'tipe' => 'upload ' . $field,
								'aktifitas' => 'Upload file [' . $field . ']',
								'date' => $date
							];
							$this->db->insert('marketing_log', $marketing_log);

							$json['success'] = TRUE;
							$json['alert'] = 'Berhasil upload';
						} else {
							$json['alert'] = $upload['msg'];
						}
					}
				}
			} else {
				$json['alert'] = 'Gagal.';
			}

			echo json_encode($json);
		}
	}

	# REKENING

	public function rekening()
	{
		$main['data'] = $this->db->query('SELECT id, kode, rekening_nama, rekening_bank, rekening_nomor FROM marketing WHERE id="' . sess('mkt') . '"')->row_array();

		if ($main['data']) {

			$this->viewku->title("Dashboard");
			$this->viewku->view("account/rekening", $main);
		}
	}

	public function editBank_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			// $this->form_validation->set_rules('id', 'id', 'trim|required|numeric');
			// $this->form_validation->set_rules('kode', 'kode', 'trim|required|xss_clean');
			$this->form_validation->set_rules('rekening_nama', 'nama pemilik rekening', 'trim|required|xss_clean');
			$this->form_validation->set_rules('rekening_nomor', 'nomor rekening', 'trim|required|numeric');
			$this->form_validation->set_rules('rekening_bank', 'bank', 'trim|required|xss_clean');

			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();

				$marketing_id = sess('mkt');

				// Start database transaction
				$this->db->trans_start();

				// update
				$marketing = [
					'rekening_nama' => $this->input->post('rekening_nama'),
					'rekening_nomor' => $this->input->post('rekening_nomor'),
					'rekening_bank' => $this->input->post('rekening_bank'),
					'date_updated' => $date
				];
				$this->db->update('marketing', $marketing, ['id' => $marketing_id]);

				// insert log
				$marketing_log = [
					'marketing_id' => $marketing_id,
					'summary' => "marketing[$marketing_id]",
					'tipe' => 'update rekening',
					'aktifitas' => 'Edit rekening',
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Update rekening gagal';
				} else {
					$json['success'] = true;
					$json['alert'] = 'Update rekening berhasil.';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	# PASSWORD

	public function password()
	{
		$main['data'] = $this->db->query('SELECT id, kode FROM marketing WHERE id="' . sess('mkt') . '"')->row_array();

		if ($main['data']) {

			$this->viewku->title("Dashboard");
			$this->viewku->view("account/password", $main);
		}
	}

	public function editPass_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			// $this->form_validation->set_rules('id', 'id', 'trim|required|numeric');
			// $this->form_validation->set_rules('kode', 'kode', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pass_lama', 'password lama', 'trim|required');
			$this->form_validation->set_rules('pass_baru_1', 'password baru', 'trim|required|min_length[6]', array(
				'matches'      => 'Password tidak sama!',
				'min_length'     => 'Password terlalu pendek!.'
			));
			$this->form_validation->set_rules('pass_baru_2', 'konfirmasi password', 'trim|required|matches[pass_baru_1]');

			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();

				$marketing_id = sess('mkt');
				$pass_lama = $this->input->post('pass_lama');
				$pass_baru = $this->input->post('pass_baru_1');

				// Start database transaction
				$this->db->trans_start();

				$user = $this->db->query("SELECT password FROM marketing WHERE id='$marketing_id'")->row_array();

				if (password_verify($pass_lama, $user['password'])) {

					// update
					$marketing = [
						'password' => password_hash($pass_baru, PASSWORD_BCRYPT),
						'date_updated' => $date
					];
					$this->db->update('marketing', $marketing, ['id' => $marketing_id]);

					// insert log
					$marketing_log = [
						'marketing_id' => $marketing_id,
						'summary' => "marketing[$marketing_id]",
						'tipe' => 'update password',
						'aktifitas' => 'Edit password',
						'date' => $date
					];
					$this->db->insert('marketing_log', $marketing_log);

					// End transaction
					$this->db->trans_complete();

					if ($this->db->trans_status() === FALSE) {
						$json['alert'] = 'Update password gagal';
					} else {
						$json['success'] = true;
						$json['alert'] = 'Update password berhasil.';
					}
				} else {
					$json['alert'] = 'Password lama tidak cocok.';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}
}
