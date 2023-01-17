<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registercomplete extends CI_Controller
{

	var $uploaded;

	function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model(array('Nasabah_model' => 'm_nasabah', 'Bank_model' => 'm_bank', 'Acc_demo_model' => 'm_demo'));
		cekLogin();
		$this->uploaded = array('identitas' => '', 'npwp' => '', 'tabungan' => '', 'foto' => '');
	}

	public function index()
	{
		//panggil demo akun
		//--

		$noacc = $this->m_demo->getData($this->session->userdata('cd_id'));
		// echo $noacc[0]->no_akun;
		$data = array(
			'button' => 'Create',
			'action' => site_url('registercomplete/save'),

			'email' => $this->session->userdata('nsb_email'),
			'nama_lengkap' => set_value('nama_lengkap'),
			'tempat_lahir' => set_value('tempat_lahir'),
			'tgl_lahir' => set_value('tgl_lahir'),
			'alamat_rumah' => set_value('alamat_rumah'),
			'kode_pos' => set_value('kode_pos'),
			'no_identitas' => set_value('no_identitas'),
			'noakundemo' => $noacc[0]->no_akun,
			'pengalaman_investasi' => set_value('pengalaman_investasi'),
			'tujuan_pembukaan_rek' => set_value('tujuan_pembukaan_rek'),
			'no_npwp' => set_value('no_npwp'),
			'status_kawin' => set_value('status_kawin'),
			'nama_pasangan' => set_value('nama_pasangan'),
			'nama_ibu' => set_value('nama_ibu'),
			'kewarganegaraan' => set_value('kewarganegaraan'),
			'status_rumah' => set_value('status_rumah'),
			'gender' => set_value('gender'),
			'no_tlp' => set_value('no_tlp'),
			'no_faksimili' => set_value('no_faksimili'),
			'keluarga_bapepti' => set_value('keluarga_bapepti'),
			'status_pailit' => set_value('status_pailit'),

			'nama_rekan' => set_value('nama_rekan'),
			'telepon_rekan' => set_value('telepon_rekan'),
			'hubungan_rekan' => set_value('hubungan_rekan'),
			'alamat_rekan' => set_value('alamat_rekan'),
			'kode_pos_rekan' => set_value('kode_pos_rekan'),

			'pekerjaan' => set_value('pekerjaan'),
			'nama_perusahaan' => set_value('nama_perusahaan'),
			'bidang_usaha' => set_value('bidang_usaha'),
			'jabatan' => set_value('jabatan'),
			'lama_kerja' => set_value('lama_kerja'),
			'kantor_sebelumnya' => set_value('kantor_sebelumnya'),
			'alamat_kantor' => set_value('alamat_kantor'),
			'kode_pos_kantor' => set_value('kode_pos_kantor'),
			'telepon_kantor' => set_value('telepon_kantor'),
			'faksimili_kantor' => set_value('faksimili_kantor'),

			'pendapatan_pertahun' => set_value('pendapatan_pertahun'),
			'lokasi_rumah' => set_value('lokasi_rumah'),
			'njob' => set_value('njob'),
			'deposit_bank' => set_value('deposit_bank'),
			'jumlah_kekayaan' => set_value('jumlah_kekayaan'),
			'kekayaan_lainnya' => set_value('kekayaan_lainnya'),

			'nama_bank' => set_value('nama_bank'),
			'cabang' => set_value('cabang'),
			'telepon_bank' => set_value('telepon_bank'),
			'no_rekening' => set_value('no_rekening'),
			'kode_bank' => set_value('kode_bank'),
			'atas_nama' => set_value('atas_nama'),
			'jenis_rekening' => set_value('jenis_rekening'),

			'nama_bank2' => set_value('nama_bank2'),
			'cabang2' => set_value('cabang2'),
			'telepon_bank2' => set_value('telepon_bank2'),
			'no_rekening2' => set_value('no_rekening2'),
			'kode_bank2' => set_value('kode_bank2'),
			'atas_nama2' => set_value('atas_nama2'),
			'jenis_rekening2' => set_value('jenis_rekening2'),

			'pict_identitas' => set_value('pict_identitas'),
			'foto_terkini' => set_value('foto_terkini'),
			'dokumen_tambahan' => set_value('dokumen_tambahan'),
		);

		$this->load->view('templates/header');
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('kabinet/auth-registercomplete-spa', $data);
		$this->load->view('templates/footer');
	}

	public function getDemo()
	{
		$var = $this->m_demo->getData($this->session->userdata('cd_id'));
		print_r($this->session->userdata('cd_id'));
		print_r($var);
	}

	public function uploadfoto()
	{
		$configured['upload_path'] = './uploads/photo/';
		$configured['allowed_types'] = 'gif|png|jpg|jpeg';
		$configured['encrypt_name'] = true;
		// $configured['max_size'] = 20480; // 1MB

		$this->upload->initialize($configured);

		if (isset($_FILES['identitas']) && !empty($_FILES['identitas']['name'])) {
			if ($this->upload->do_upload('identitas')) {
				$this->uploaded['identitas'] = $this->upload->data("file_name");
			} else {
				$this->uploaded['identitas'] = "default.jpg";
			}
		}

		if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {
			if ($this->upload->do_upload('photo')) {
				$this->uploaded['foto'] = $this->upload->data("file_name");
			} else {
				$this->uploaded['foto'] = "default.jpg";
			}
		}

		if (isset($_FILES['tabungan']) && !empty($_FILES['tabungan']['name'])) {
			if ($this->upload->do_upload('tabungan')) {
				$this->uploaded['tabungan'] = $this->upload->data("file_name");
			} else {
				$this->uploaded['tabungan'] = "default.jpg";
			}
		}

		if (isset($_FILES['npwp']) && !empty($_FILES['npwp']['name'])) {
			if ($this->upload->do_upload('npwp')) {
				$this->uploaded['npwp'] = $this->upload->data("file_name");
			} else {
				$this->uploaded['npwp'] = "default.jpg";
			}
		}
		// echo json_encode(array('identitas' => $this->uploaded['identitas'], 'npwp' => $this->uploaded['npwp'], 'tabungan' => $this->uploaded['tabungan'], 'foto' => $this->uploaded['foto']));
	}

	public function save()
	{

		$this->uploadfoto();

		$data = array(
			'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
			'gender' => $this->input->post('gender', TRUE),
			'no_hp' => $this->input->post('no_tlp', TRUE),
			'email' => $this->session->userdata('nsb_email'),
			// Password dikosongkan
			// 'password' => $this->session->userdata('nsb_password'),
			'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
			'tgl_lahir' => $this->input->post('tgl_lahir', TRUE),
			'alamat_rumah' => $this->input->post('alamat_rumah', TRUE),
			'kode_pos' => $this->input->post('kode_pos', TRUE),
			// Jenis Identitas harcoded KTP berhubung tidak ada pilihan di form
			'jenis_identitas' => "KTP",
			'no_identitas' => $this->input->post('no_identitas', TRUE),
			'status_kawin' => $this->input->post('status_kawin', TRUE),
			'nama_pasangan' => $this->input->post('nama_pasangan', TRUE),
			'nama_ibu' => $this->input->post('nama_ibu', TRUE),
			'no_tlp' => $this->input->post('no_tlp', TRUE),
			'no_faksimili' => $this->input->post('no_faksimili', TRUE),
			'no_npwp' => $this->input->post('no_npwp', TRUE),
			'alamat_surat_menyurat' => $this->input->post('alamat_rumah', TRUE),
			'status_rumah' => $this->input->post('status_rumah', TRUE),
			'pengalaman_investasi' => $this->input->post('pengalaman_investasi', TRUE),
			'kewarganegaraan' => $this->input->post('kewarganegaraan', TRUE),
			'tujuan_pembukaan_rek' => $this->input->post('tujuan_pembukaan_rek', TRUE),
			'keluarga_bapepti' => $this->input->post('keluarga_bapepti', TRUE),
			'status_pailit' => $this->input->post('status_pailit', TRUE),
			'nama_rekan' => $this->input->post('nama_rekan', TRUE),
			'telepon_rekan' => $this->input->post('telepon_rekan', TRUE),
			'hubungan_rekan' => $this->input->post('hubungan_rekan', TRUE),
			'alamat_rekan' => $this->input->post('alamat_rekan', TRUE),
			'kode_pos_rekan' => $this->input->post('kode_pos_rekan', TRUE),
			'pekerjaan' => $this->input->post('pekerjaan', TRUE),
			'nama_perusahaan' => $this->input->post('nama_perusahaan', TRUE),
			'bidang_usaha' => $this->input->post('bidang_usaha', TRUE),
			'jabatan' => $this->input->post('jabatan', TRUE),
			'lama_kerja' => $this->input->post('lama_kerja', TRUE),
			'alamat_kantor' => $this->input->post('alamat_kantor', TRUE),
			'kode_pos_kantor' => $this->input->post('kode_pos_kantor', TRUE),
			'telepon_kantor' => $this->input->post('telepon_kantor', TRUE),
			'faksimili_kantor' => $this->input->post('faksimili_kantor', TRUE),
			'kantor_sebelumnya' => $this->input->post('kantor_sebelumnya', TRUE) ?: ' ',
			'pendapatan_pertahun' => $this->input->post('pendapatan_pertahun', TRUE),
			'lokasi_rumah' => $this->input->post('lokasi_rumah', TRUE),
			'njob' => $this->input->post('njob', TRUE),
			'deposit_bank' => $this->input->post('deposit_bank', TRUE),
			'jumlah_kekayaan' => $this->input->post('jumlah_kekayaan', TRUE),
			'kekayaan_lainnya' => $this->input->post('kekayaan_lainnya', TRUE),
			'pict_identitas' => $this->uploaded['identitas'],
			'foto_terkini' => $this->uploaded['foto'],
			'foto_buku_tabungan' => $this->uploaded['tabungan'],
			'foto_npwp' => $this->uploaded['npwp'],

			'status' => 'Complete',

			'update_date' => date('Y-m-d h:i:S'),
		);




		$dataBankIDR = array(
			'nasabah_id' => $this->session->userdata('cd_id'),
			'nama_bank' => $this->input->post('nama_bank', TRUE),
			'cabang' => $this->input->post('cabang', TRUE),
			'telepon_bank' => $this->input->post('telepon_bank', TRUE),
			'no_rekening' => $this->input->post('no_rekening', TRUE),
			'kode_bank' => $this->input->post('kode_bank', TRUE),
			'atas_nama' => $this->input->post('atas_nama', TRUE),
			'jenis_rekening' => $this->input->post('jenis_rekening', TRUE),
			'currency' => 'IDR',
			'created_date' => date('Y-m-d h:i:s'),
			'status_bank' => 'Pending'
		);

		$dataBankUSD = array(
			'nasabah_id' => $this->session->userdata('cd_id'),
			'nama_bank' => $this->input->post('nama_bank2', TRUE) ?: ' ',
			'cabang' => $this->input->post('cabang2', TRUE) ?: ' ',
			'telepon_bank' => $this->input->post('telepon_bank2', TRUE) ?: ' ',
			'no_rekening' => $this->input->post('no_rekening2', TRUE) ?: ' ',
			'kode_bank' => $this->input->post('kode_bank2', TRUE) ?: ' ',
			'atas_nama' => $this->input->post('atas_nama2', TRUE) ?: ' ',
			'jenis_rekening' => $this->input->post('jenis_rekening2', TRUE) ?: ' ',
			'currency' => 'USD',
			'created_date' => date('Y-m-d h:i:s'),
			'status_bank' => 'Pending'
		);

		$this->m_nasabah->update($this->session->userdata('cd_id'), $data);
		$this->m_bank->insert($dataBankIDR);

		if ($dataBankUSD['nama_bank'] != ' ' && $dataBankUSD['cabang'] != ' ' && $dataBankUSD['telepon_bank'] != ' ' && $dataBankUSD['no_rekening'] != ' ' && $dataBankUSD['kode_bank'] != ' ' && $dataBankUSD['atas_nama'] != ' ' && $dataBankUSD['jenis_rekening'] != ' ') {
			$this->m_bank->insert($dataBankUSD);
		}

		$data = array('nsb_photo' => $data['foto_terkini'], 'nsb_nama' => $data['nama_lengkap'], 'nsb_status' => $data['status']);

		//menyimpan session
		$this->session->set_userdata($data);

		$this->_sendEmail();

		$dataas = array('success' => true, 'message' => 'registrasi berhasil');
		echo json_encode($dataas);
	}

	private function _sendEmail()
	{
		// Konfigurasi email
		$config['useragent']      = 'CodeIgniter';
		$config['protocol']       = 'smtp';
		$config['smtp_crypto']    = 'tls'; // tls or ssl
		$config['smtp_host']      = 'mail.tfx.co.id';
		$config['smtp_user']      = 'support@tifia.co.id';
		$config['smtp_pass']      = '4r3Z/F9KaM';
		$config['smtp_port']      = 587;
		$config['smtp_timeout']   = 20;
		$config['wordwrap']       = true;
		$config['wrapchars']      = 76;
		$config['mailtype']       = 'html';
		$config['charset']        = 'utf-8';
		$config['validate']       = false;
		$config['priority']       = 3;
		$config['crlf']           = "\r\n";
		$config['newline']        = "\r\n";
		$config['bcc_batch_mode'] = false;
		$config['bcc_batch_size'] = 200;

		// Load library email dan konfigurasinya
		$this->email->initialize($config);

		// Email dan nama pengirim
		$this->email->from('support@tifia.co.id', 'PT. Tifia Finansial Berjangka');

		// Email penerima
		$this->email->to('Manager@tifia.co.id');

		// Subject email
		$this->email->subject('Register Complete');

		// Isi email
		$message = 'Dear admin, seorang nasabah dengan akun ' . $this->session->userdata('nsb_email') . ' telah melakukan register complete. Mohon untuk segera melakukan approval.';
		$this->email->message($message);

		// $this->email->message('huu');

		// Tampilkan pesan sukses atau error
		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die();
		}
	}

	public function test()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('kabinet/coba');
		$this->load->view('templates/footer');
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required|alpha');
		$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required|alpha');
		$this->form_validation->set_rules('alamat_rumah', 'alamat rumah', 'trim|required');
		$this->form_validation->set_rules('kode_pos', 'kode pos', 'trim|required|numeric|min_length[5]|max_length[6]');
		$this->form_validation->set_rules('no_identitas', 'no identitas', 'trim|required|exact_length[16]');
		$this->form_validation->set_rules('pengalaman_investasi', 'pengalaman investasi', 'trim|required');
		$this->form_validation->set_rules('tujuan_pembukaan_rek', 'tujuan pembukaan rek', 'trim|required');
		$this->form_validation->set_rules('no_npwp', 'no npwp', 'trim|required|numeric|exact_length[16]');
		$this->form_validation->set_rules('status_kawin', 'status kawin', 'trim|required');
		$this->form_validation->set_rules('nama_pasangan', 'status kawin', 'trim|alpha');
		$this->form_validation->set_rules('nama_ibu', 'nama ibu', 'trim|required|alpha');
		$this->form_validation->set_rules('kewarganegaraan', 'kewarganegaraan', 'trim|required|alpha');
		$this->form_validation->set_rules('status_rumah', 'status rumah', 'trim|required');
		$this->form_validation->set_rules('gender', 'gender', 'trim|required');
		$this->form_validation->set_rules('no_tlp', 'no tlp', 'trim|required|numeric|min_length[11]|max_length[13]');
		$this->form_validation->set_rules('no_faksimili', 'no faksimili', 'trim|required|numeric|min_length[11]|max_length[13]');
		$this->form_validation->set_rules('keluarga_bapepti', 'keluarga bapepti', 'trim|required');
		$this->form_validation->set_rules('status_pailit', 'status pailit', 'trim|required');

		$this->form_validation->set_rules('nama_rekan', 'nama rekan', 'trim|required|alpha');
		$this->form_validation->set_rules('telepon_rekan', 'telepon rekan', 'trim|required|min_length[11]|max_length[13]');
		$this->form_validation->set_rules('hubungan_rekan', 'hubungan rekan', 'trim|required');
		$this->form_validation->set_rules('alamat_rekan', 'alamat rekan', 'trim|required');
		$this->form_validation->set_rules('kode_pos_rekan', 'kode pos rekan', 'trim|required|min_length[5]|max_length[6]');

		$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required');
		$this->form_validation->set_rules('nama_perusahaan', 'nama perusahaan', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('bidang_usaha', 'bidang usaha', 'trim|required');
		$this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('lama_kerja', 'lama kerja', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('alamat_kantor', 'alamat kantor', 'trim|required');
		$this->form_validation->set_rules('kode_pos_kantor', 'kode pos kantor', 'trim|required|min_length[5]|max_length[6]');
		$this->form_validation->set_rules('telepon_kantor', 'telepon kantor', 'trim|required|min_length[11]|max_length[13]');
		$this->form_validation->set_rules('faksimili_kantor', 'faksimili kantor', 'trim|required|min_length[11]|max_length[13]');
		$this->form_validation->set_rules('kantor_sebelumnya', 'kantor sebelumnya', 'trim|required');

		$this->form_validation->set_rules('pendapatan_pertahun', 'pendapatan pertahun', 'trim|required');
		$this->form_validation->set_rules('lokasi_rumah', 'lokasi rumah', 'trim|required');
		$this->form_validation->set_rules('njob', 'njob', 'trim|required');
		$this->form_validation->set_rules('deposit_bank', 'deposit bank', 'trim|required');
		$this->form_validation->set_rules('jumlah_kekayaan', 'jumlah kekayaan', 'trim|required');
		$this->form_validation->set_rules('kekayaan_lainnya', 'kekayaan lainnya', 'trim|required');

		$this->form_validation->set_rules('nama_bank', 'nama_bank', 'trim|required');
		$this->form_validation->set_rules('cabang', 'cabang', 'trim|required');
		$this->form_validation->set_rules('telepon_bank', 'telepon_bank', 'trim|required|min_length[11]|max_length[13]');
		$this->form_validation->set_rules('no_rekening', 'no_rekening', 'trim|required|numeric');
		$this->form_validation->set_rules('kode_bank', 'kode_bank', 'trim|required');
		$this->form_validation->set_rules('atas_nama', 'atas_nama', 'trim|required|alpha');
		$this->form_validation->set_rules('jenis_rekening', 'jenis_rekening', 'trim|required');

		$this->form_validation->set_rules('nama_bank2', 'nama_bank usd', 'trim|required');
		$this->form_validation->set_rules('cabang2', 'cabang usd', 'trim|required');
		$this->form_validation->set_rules('telepon_bank2', 'telepon_bank usd', 'trim|required|min_length[11]|max_length[13]');
		$this->form_validation->set_rules('no_rekening2', 'no_rekening usd', 'trim|required|numeric');
		$this->form_validation->set_rules('kode_bank2', 'kode_bank usd', 'trim|required');
		$this->form_validation->set_rules('atas_nama2', 'atas_nama usd', 'trim|required|alpha');
		$this->form_validation->set_rules('jenis_rekening2', 'jenis_rekening usd', 'trim|required');

		$this->form_validation->set_rules('identitas', 'pict identitas', 'callback_validate_identitas');
		$this->form_validation->set_rules('photo', 'foto terkini', 'callback_validate_foto');
		$this->form_validation->set_rules('image3', 'npwp', 'callback_validate_npwp');

		$this->form_validation->set_rules('nasabah_id', 'nasabah_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function validate_foto()
	{
		$config['upload_path'] = './uploads/photo/terkini/';
		// $config['max_size'] = 1024 * 10;
		$config['allowed_types'] = 'gif|png|jpg|jpeg';

		$this->load->library('upload', $config);

		if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {
			if ($this->upload->do_upload('photo')) {
				$upload_data = $this->upload->data();
				echo $upload_data['file_name'];

				$this->foto = $upload_data['file_name'];
				return TRUE;
			} else {
				$this->form_validation->set_message('validate_image', $this->upload->display_errors());
				return FALSE;
				echo $this->upload->display_errors();
				die();
			}
		} else {
			$this->foto = "";
			return FALSE;
		}
	}

	public function validate_identitas()
	{
		$config['upload_path'] = './uploads/photo/identitas/';
		// $config['max_size'] = 1024 * 10;
		$config['allowed_types'] = 'gif|png|jpg|jpeg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if (isset($_FILES['identitas']) && !empty($_FILES['identitas']['name'])) {
			if ($this->upload->do_upload('identitas')) {
				$upload_data = $this->upload->data();
				$this->identitas = $upload_data['file_name'];
				return TRUE;
			} else {
				$this->form_validation->set_message('validate_image', $this->upload->display_errors());
				return FALSE;
				echo $this->upload->display_errors();
				die();
			}
		} else {
			$this->identitas = "";
			return FALSE;
		}
	}

	public function validate_npwp()
	{
		$config['upload_path'] = './uploads/photo/npwp/';
		// $config['max_size'] = 1024 * 10;
		$config['allowed_types'] = 'gif|png|jpg|jpeg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if (isset($_FILES['npwp']) && !empty($_FILES['npwp']['name'])) {
			if ($this->upload->do_upload('npwp')) {
				$upload_data = $this->upload->data();
				$this->npwp = $upload_data['file_name'];
				return TRUE;
			} else {
				$this->form_validation->set_message('validate_image', $this->upload->display_errors());
				return FALSE;
				echo $this->upload->display_errors();
				die();
			}
		} else {
			$this->npwp = NULL;
			return FALSE;
		}
	}

	public function validate_tabungan()
	{
		$config['upload_path'] = './uploads/photo/tabungan/';
		// $config['max_size'] = 1024 * 10;
		$config['allowed_types'] = 'gif|png|jpg|jpeg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if (isset($_FILES['tabungan']) && !empty($_FILES['tabungan']['name'])) {
			if ($this->upload->do_upload('tabungan')) {
				$upload_data = $this->upload->data();
				$this->tabungan = $upload_data['file_name'];
				return TRUE;
			} else {
				$this->form_validation->set_message('validate_image', $this->upload->display_errors());
				return FALSE;
				echo $this->upload->display_errors();
				die();
			}
		} else {
			$this->tabungan = NULL;
			return FALSE;
		}
	}
}
