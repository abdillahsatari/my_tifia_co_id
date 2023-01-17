<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model(['sales/Sales_model' => 'model']);
	}

	public function index()
	{
		$data['title'] = 'List Sales';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Marketing' => '#',
			'List' => '#',
		];
		$data['page'] = 'admin_marketing/sales/index';
		$this->load->view('template/backend', $data);
	}

	public function view($marketing_id)
	{
		$query = $this->db->query("SELECT * FROM marketing WHERE id='$marketing_id'");
		if ($query->num_rows() > 0) {
			$data['data'] = $query->row_array();

			$data['title'] = 'Lihat data sales';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Marketing' => '#',
				'View' => '#',
			];
			$data['page'] = 'admin_marketing/sales/view';
			$this->load->view('template/backend', $data);
		}
	}

	public function agreement($marketing_id)
	{
		$query = $this->db->query("SELECT marketing.*, marketing_role.role FROM marketing, marketing_role WHERE marketing.role_id=marketing_role.id AND marketing.id='$marketing_id' AND marketing.status_perjanjian='Approved'");
		if ($query->num_rows() > 0) {
			$data['user'] = $query->row_array();



			require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
			$dompdf = new Dompdf();

			$html =  $this->load->view('admin_marketing/sales/agreement', $data, true);
			$dompdf->load_html($html);
			$dompdf->set_paper('A4', 'portrait');
			$dompdf->render();
			$pdf = $dompdf->output();
			#Output the generated PDF to Browser
			$dompdf->stream('Nota Kesepakatan Kerjasama.pdf', array("Attachment" => false));
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
			$this->form_validation->set_rules('status_verify', 'status verifikasi email', 'trim|required|in_list[Y,T]');

			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();

				$marketing_id = $this->input->post('id');


				// Start database transaction
				$this->db->trans_start();

				// update
				$marketing = [
					'role_id' => $this->input->post('role'),
					'nama' => $this->input->post('nama'),
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
					'status_verify' => $this->input->post('status_verify'),
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
				// $marketing_log = [
				// 	'marketing_id' => $marketing_id,
				// 	'summary' => "marketing[$marketing_id]",
				// 	'tipe' => 'update profile',
				// 	'aktifitas' => 'Edit profile',
				// 	'date' => $date
				// ];
				// $this->db->insert('marketing_log', $marketing_log);

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
							// $marketing_log = [
							// 	'marketing_id' => $marketing_id,
							// 	'summary' => "marketing[$marketing_id]",
							// 	'tipe' => 'upload ' . $field,
							// 	'aktifitas' => 'Upload file [' . $field . ']',
							// 	'date' => $date
							// ];
							// $this->db->insert('marketing_log', $marketing_log);

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

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "marketing.xls";
		$judul = "marketing";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Kode");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama");
		xlsWriteLabel($tablehead, $kolomhead++, "No. HP");
		xlsWriteLabel($tablehead, $kolomhead++, "Email");
		xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
		xlsWriteLabel($tablehead, $kolomhead++, "Provinsi");
		xlsWriteLabel($tablehead, $kolomhead++, "Kabupaten");
		xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
		xlsWriteLabel($tablehead, $kolomhead++, "Kelurahan");
		xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");
		xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
		xlsWriteLabel($tablehead, $kolomhead++, "Status");
		xlsWriteLabel($tablehead, $kolomhead++, "Pendidikan");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Pemilik Rekening");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Bank");
		xlsWriteLabel($tablehead, $kolomhead++, "Nomor Rekening");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Registrasi");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Terakhir Diperbarui");

		foreach ($this->model->get_all() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
			xlsWriteLabel($tablebody, $kolombody++, $data->email);
			xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
			xlsWriteLabel($tablebody, $kolombody++, $data->provinsi);
			xlsWriteLabel($tablebody, $kolombody++, $data->kabupaten);
			xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
			xlsWriteLabel($tablebody, $kolombody++, $data->kelurahan);
			xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
			xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lahir);
			xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
			xlsWriteLabel($tablebody, $kolombody++, $data->status);
			xlsWriteLabel($tablebody, $kolombody++, $data->pendidikan);
			xlsWriteLabel($tablebody, $kolombody++, $data->rekening_nama);
			xlsWriteLabel($tablebody, $kolombody++, $data->rekening_bank);
			xlsWriteLabel($tablebody, $kolombody++, $data->rekening_nomor);
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

	function fetch_team()
	{
		$fetch_data = $this->model->make_datatables_team();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			$sub_array = array();
			$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-left">
								<span class="text-danger font-weight-bold">' . $r->kode . '</span>
								<br>
								' . ucfirst($r->nama) . '
								</div>';
			$sub_array[] =  '<div class="text-center">' . $r->email . '<br>' . $r->no_hp . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->kota_asal . '</div>';
			$sub_array[] =  '<div class="text-center"><code>' . ($r->status_verify == 'T' ? 'Belum verifikasi' : 'Sudah verifikasi') . '</code></div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->date_added, 'd/m/Y') . '</div>';
			$btnnn = '<div class="text-center">
						<a href="' . base_url('adminarea/marketing/sales/view/' . $r->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-user"></i> Profile</a>';
			if ($r->status_perjanjian == 'Approved') {
				$btnnn .= '<a href="' . base_url('adminarea/marketing/sales/agreement/' . $r->id) . '" class="btn btn-xs btn-success"><i class="fa fa-file"></i> Agreement</a>';
			}
			$btnnn .= '</div>';
			$sub_array[] = $btnnn;
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
