<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole('2');
		agreement_check();
		$this->load->library('Tree');
		$this->load->helper('tree');
		$this->load->model(['Sales_model' => 'model']);
	}

	public function index()
	{
		$this->myteam();
	}

	public function myteam()
	{
		$this->viewku->title("My Team");
		$this->viewku->view("sales/list");
	}

	public function tree($marketing_id)
	{
		$main = [
			'marketing_id' => $marketing_id,
			'pohon' => $this->tree->pohon($marketing_id)
		];

		$this->viewku->title("Tree");
		$this->viewku->view("sales/pohon_jaringan", $main);
	}

	public function register()
	{
		$mitra = mitra(sess('mkt'));
		if ($mitra['role_id'] != '5') {
			$main['kode'] = generate_kd(6, after_last_id('marketing', 'id'));
			$this->viewku->title("Register Sales");
			$this->viewku->view("sales/tambah", $main);
		} else {
			flash_alert('Anda tidak dapat menambah mitra!', 'danger');
			redirect('dashboard');
		}
	}

	public function register_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			$this->rules();
			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();

				$marketing_id = sess('mkt');
				// $marketing_id = NULL;

				// Start database transaction
				$this->db->trans_start();

				// generate password
				$pass = substr(md5(mt_rand()), 0, 6);
				$passRandomHASH = password_hash($pass, PASSWORD_BCRYPT);

				// insert calon nasabah
				$marketing = [
					'role_id' => 5,
					'parent_id' => $marketing_id,
					'kode' => '0',
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email'),
					'password' => $passRandomHASH,
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
					'status_verify' => 'T',
					'status_login' => '0',
					'is_deleted' => '0',
					'date_added' => $date
				];
				$this->db->insert('marketing', $marketing);
				$id_marketing_baru = $this->db->insert_id();

				$kode = 'MTFX-' . generate_kd(6, $id_marketing_baru);
				$this->db->update('marketing', ['kode' => $kode], ['id' => $id_marketing_baru]);

				// siapakan token untuk dikirim ke email
				$token = random_string('alnum', 64);
				$user_token = ['email' => $this->input->post('email'), 'token' => $token, 'created_date' => time()];
				$this->db->insert('marketing_token', $user_token);

				// insert log
				$marketing_log = [
					'marketing_id' => $marketing_id,
					'summary' => "marketing[$id_marketing_baru]",
					'tipe' => 'tambah sales',
					'aktifitas' => 'Tambah sales [' . $kode . ']',
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Tambah sales gagal';
				} else {

					# kirim email untuk verifikasi berisi email dan password
					// prepare Email
					$isi_email = [
						'nama' => $this->input->post('nama'),
						'email' => $this->input->post('email'),
						'password' => $pass,
						'token' => $token,
					];

					// Load helper email dan konfigurasinya
					$this->load->helper('send_email_helper');
					$data_email['email'] = $this->input->post('email');
					$data_email['pesan'] = $this->getEmailBody($isi_email);
					$data_email['subjek'] = 'Tahap terakhir untuk bergabung menjadi Mitra';
					send_mailer($data_email);

					$json['success'] = true;
					$json['alert'] = 'Tambah sales berhasil. Mohon upload dokumen sales.';
					$json['href'] = base_url() . 'dashboard/sales/edit/' . $kode . '?type=upload#file_foto';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	public function edit($kode)
	{
		$marketing_id = sess('mkt');

		$query = $this->db->query("SELECT * FROM marketing where kode='$kode' AND parent_id='$marketing_id'");
		if ($query->num_rows() > 0) {
			$main['data'] = $query->row_array();

			$this->viewku->title("Register Sales");
			$this->viewku->view("sales/edit", $main);
		}
	}

	public function edit_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			$this->form_validation->set_rules('id', 'id', 'trim|required|numeric');
			$this->form_validation->set_rules('kode', 'kode', 'trim|required|xss_clean');
			$this->rules();

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();

				$id_saya = sess('mkt');
				$marketing_id = $this->input->post('id');

				// Start database transaction
				$this->db->trans_start();

				// insert calon nasabah
				$marketing = [
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email'),
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
				$this->db->update('marketing', $marketing, ['id' => $marketing_id]);

				// insert log
				$marketing_log = [
					'marketing_id' => $id_saya,
					'summary' => "marketing[$marketing_id]",
					'tipe' => 'update sales',
					'aktifitas' => 'Edit data sales [' . $this->input->post('kode') . ']',
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Update data sales gagal';
				} else {

					$json['success'] = true;
					$json['alert'] = 'Update data sales berhasil.';
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
		$this->form_validation->set_rules('nama', 'nama', 'trim|required|xss_clean');
		$this->form_validation->set_rules(
			'email',
			'email',
			'trim|required|valid_email|is_unique[marketing.email]',
			array('is_unique' => 'Email sudah terdaftar!')
		);
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
	}

	private function getEmailBody($data)
	{
		$msg = $this->load->view('template_email/email_aktivasi', ['user' => $data], true);

		return $msg;
	}

	public function upload_files()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['success' => false, 'alert' => 'Error.'];

			$id_saya = sess('mkt');
			$marketing_id = $this->input->post('marketing_id');

			$query = $this->db->query("SELECT * FROM marketing where id='$marketing_id' AND parent_id='$id_saya'");
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

				for ($i = 0; $i < 5; $i++) {
					if ($files[$i]['nama'] == $field) {
						$upload = upload_image($field, './uploads/marketing', 'MKT_', $files[$i]['tipe'], $files[$i]['max_size']);

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
								'marketing_id' => $id_saya,
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


	// ################################################
	// datatables

	function fetch_team()
	{
		$fetch_data = $this->model->make_datatables_team();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			$sub_array = array();
			$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-left">
								<a href="' . base_url('dashboard/sales/tree/' . $r->id) . '" class="text-danger font-weight-bold">' . $r->kode . ' <i class="fa fa-users"></i></a>
								<br>
								' . ucfirst($r->nama) . '
								</div>';
			$sub_array[] =  '<div class="text-center">' . $r->role . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->email . '<br>' . $r->no_hp . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->kota_asal . '</div>';
			$sub_array[] =  '<div class="text-center"><code>' . ($r->status_verify == 'T' ? 'Belum verifikasi' : 'Sudah verifikasi') . '</code></div>';
			$data[] = $sub_array;
			$no++;
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->model->get_all_data_team(),
			"recordsFiltered" => $this->model->get_filtered_data_team(),
			"data" => $data
		);
		echo json_encode($output);
	}
}
