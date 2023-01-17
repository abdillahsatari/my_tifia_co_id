<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Nasabah extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model('Nasabah_model');
		$this->load->model('Log_model');
		$this->load->model('Bank_model');
		$this->load->model('Acc_request_model');
		$this->load->model('Users_pesan_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}

	public function index()
	{
		$data['title'] = 'Nasabah';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Nasabah' => '',
		];
		$data['code_js'] = 'nasabah/codejs';
		$data['page'] = 'nasabah/nasabah_list';
		$this->load->view('template/backend', $data);
	}

	public function json() {
		header('Content-Type: application/json');
		echo $this->Nasabah_model->json();
	}

	public function read($id)
	{
		$row = $this->Nasabah_model->get_by_id($id);
		if ($row) {
			$data = array(
				'nasabah_id' => $row->nasabah_id,
				'nama_lengkap' => $row->nama_lengkap,
				'gender' => $row->gender,
				'no_hp' => $row->no_hp,
				'email' => $row->email,
				'password' => $row->password,
				'tempat_lahir' => $row->tempat_lahir,
				'tgl_lahir' => $row->tgl_lahir,
				'alamat_rumah' => $row->alamat_rumah,
				'kode_pos' => $row->kode_pos,
				'jenis_identitas' => $row->jenis_identitas,
				'no_identitas' => $row->no_identitas,
				'status_kawin' => $row->status_kawin,
				'nama_pasangan' => $row->nama_pasangan,
				'nama_ibu' => $row->nama_ibu,
				'no_tlp' => $row->no_tlp,
				'no_faksimili' => $row->no_faksimili,
				'no_npwp' => $row->no_npwp,
				'alamat_surat_menyurat' => $row->alamat_surat_menyurat,
				'status_rumah' => $row->status_rumah,
				'pengalaman_investasi' => $row->pengalaman_investasi,
				'kewarganegaraan' => $row->kewarganegaraan,
				'tujuan_pembukaan_rek' => $row->tujuan_pembukaan_rek,
				'keluarga_bapepti' => $row->keluarga_bapepti,
				'status_pailit' => $row->status_pailit,
				'nama_rekan' => $row->nama_rekan,
				'telepon_rekan' => $row->telepon_rekan,
				'hubungan_rekan' => $row->hubungan_rekan,
				'alamat_rekan' => $row->alamat_rekan,
				'kode_pos_rekan' => $row->kode_pos_rekan,
				'pekerjaan' => $row->pekerjaan,
				'nama_perusahaan' => $row->nama_perusahaan,
				'bidang_usaha' => $row->bidang_usaha,
				'jabatan' => $row->jabatan,
				'lama_kerja' => $row->lama_kerja,
				'alamat_kantor' => $row->alamat_kantor,
				'kode_pos_kantor' => $row->kode_pos_kantor,
				'telepon_kantor' => $row->telepon_kantor,
				'faksimili_kantor' => $row->faksimili_kantor,
				'kantor_sebelumnya' => $row->kantor_sebelumnya,
				'pendapatan_pertahun' => $row->pendapatan_pertahun,
				'lokasi_rumah' => $row->lokasi_rumah,
				'njob' => $row->njob,
				'deposit_bank' => $row->deposit_bank,
				'jumlah_kekayaan' => $row->jumlah_kekayaan,
				'kekayaan_lainnya' => $row->kekayaan_lainnya,
				'pict_identitas' => $row->pict_identitas,
				'foto_terkini' => $row->foto_terkini,
				'foto_npwp' => $row->foto_npwp,
				'foto_buku_tabungan' => $row->foto_buku_tabungan,
				'jenis_dokumen_tambahan' => $row->jenis_dokumen_tambahan,
				'dokumen_tambahan' => $row->dokumen_tambahan,
				'perusahaan_simulasi' => $row->perusahaan_simulasi,
				'penyelesaian_perselisihan' => $row->penyelesaian_perselisihan,
				'daftar_kantor' => $row->daftar_kantor,
				'status' => $row->status,
				'status_verify' => $row->status_verify,
				'is_active' => $row->is_active,
				'komentar' => $row->komentar,
				'nasabah_role_id' => $row->nasabah_role_id,
				'created_date' => $row->created_date,
				'user_id' => $row->user_id,
				'update_date' => $row->update_date,
				'update_user_id' => $row->update_user_id,
			);
			$data['title'] = 'Nasabah';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			$data['page'] = 'nasabah/nasabah_read';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('nasabah'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('adminarea/nasabah/create_action'),
			'nasabah_id' => set_value('nasabah_id'),
			'nama_lengkap' => set_value('nama_lengkap'),
			'gender' => set_value('gender'),
			'no_hp' => set_value('no_hp'),
			'email' => set_value('email'),
			'tempat_lahir' => set_value('tempat_lahir'),
			'tgl_lahir' => set_value('tgl_lahir'),
			'alamat_rumah' => set_value('alamat_rumah'),
			'kode_pos' => set_value('kode_pos'),
			'jenis_identitas' => set_value('jenis_identitas'),
			'no_identitas' => set_value('no_identitas'),
			'status_kawin' => set_value('status_kawin'),
			'nama_pasangan' => set_value('nama_pasangan'),
			'nama_ibu' => set_value('nama_ibu'),
			'no_tlp' => set_value('no_tlp'),
			'no_faksimili' => set_value('no_faksimili'),
			'no_npwp' => set_value('no_npwp'),
			'alamat_surat_menyurat' => set_value('alamat_surat_menyurat'),
			'status_rumah' => set_value('status_rumah'),
			'pengalaman_investasi' => set_value('pengalaman_investasi'),
			'kewarganegaraan' => set_value('kewarganegaraan'),
			'tujuan_pembukaan_rek' => set_value('tujuan_pembukaan_rek'),
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
			'alamat_kantor' => set_value('alamat_kantor'),
			'kode_pos_kantor' => set_value('kode_pos_kantor'),
			'telepon_kantor' => set_value('telepon_kantor'),
			'faksimili_kantor' => set_value('faksimili_kantor'),
			'kantor_sebelumnya' => set_value('kantor_sebelumnya'),
			'pendapatan_pertahun' => set_value('pendapatan_pertahun'),
			'lokasi_rumah' => set_value('lokasi_rumah'),
			'njob' => set_value('njob'),
			'deposit_bank' => set_value('deposit_bank'),
			'jumlah_kekayaan' => set_value('jumlah_kekayaan'),
			'kekayaan_lainnya' => set_value('kekayaan_lainnya'),
			'pict_identitas' => set_value('pict_identitas'),
			'foto_terkini' => set_value('foto_terkini'),
			'foto_npwp' => set_value('foto_npwp'),
			'foto_buku_tabungan' => set_value('foto_buku_tabungan'),

			'nama_bank' => set_value('nama_bank'),
			'no_rekening' => set_value('no_rekening'),
			'cabang' => set_value('cabang'),
			'jenis_rekening' => set_value('jenis_rekening'),
			'telepon_bank' => set_value('telepon_bank'),
			'kode_bank' => set_value('kode_bank'),
			'atas_nama' => set_value('atas_nama'),

			'nama_bank2' => set_value('nama_bank2'),
			'no_rekening2' => set_value('no_rekening2'),
			'cabang2' => set_value('cabang2'),
			'jenis_rekening2' => set_value('jenis_rekening2'),
			'telepon_bank2' => set_value('telepon_bank2'),
			'kode_bank2' => set_value('kode_bank2'),
			'atas_nama2' => set_value('atas_nama2'),
		);
		$data['title'] = 'Nasabah';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Dashboard' => '',
		];

		$data['page'] = 'nasabah/nasabah_form';
		$this->load->view('template/backend', $data);
	}

	public function create_action()
	{
		$user = $this->ion_auth->user()->row();

		$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
		$this->form_validation->set_rules('gender', 'gender', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
		$this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
		$this->form_validation->set_rules('alamat_rumah', 'alamat rumah', 'trim|required');
		$this->form_validation->set_rules('kode_pos', 'kode pos', 'trim|required');
		$this->form_validation->set_rules('jenis_identitas', 'jenis identitas', 'trim|required');
		$this->form_validation->set_rules('no_identitas', 'no identitas', 'trim|required');
		$this->form_validation->set_rules('status_kawin', 'status kawin', 'trim|required');
		$this->form_validation->set_rules('nama_ibu', 'nama ibu', 'trim|required');
		$this->form_validation->set_rules('no_tlp', 'no tlp', 'trim|required');
		$this->form_validation->set_rules('no_faksimili', 'no faksimili', 'trim');
		$this->form_validation->set_rules('no_npwp', 'no npwp', 'trim|required');

		$this->form_validation->set_rules('status_rumah', 'status rumah', 'trim|required');
		$this->form_validation->set_rules('pengalaman_investasi', 'pengalaman investasi', 'trim|required');
		$this->form_validation->set_rules('kewarganegaraan', 'kewarganegaraan', 'trim|required');
		$this->form_validation->set_rules('tujuan_pembukaan_rek', 'tujuan pembukaan rek', 'trim|required');
		$this->form_validation->set_rules('keluarga_bapepti', 'keluarga bapepti', 'trim|required');
		$this->form_validation->set_rules('status_pailit', 'status pailit', 'trim|required');
		$this->form_validation->set_rules('nama_rekan', 'nama rekan', 'trim|required');
		$this->form_validation->set_rules('telepon_rekan', 'telepon rekan', 'trim|required');
		$this->form_validation->set_rules('hubungan_rekan', 'hubungan rekan', 'trim|required');
		$this->form_validation->set_rules('alamat_rekan', 'alamat rekan', 'trim|required');
		$this->form_validation->set_rules('kode_pos_rekan', 'kode pos rekan', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required');
		$this->form_validation->set_rules('nama_perusahaan', 'nama perusahaan', 'trim');
		$this->form_validation->set_rules('bidang_usaha', 'bidang usaha', 'trim');
		$this->form_validation->set_rules('jabatan', 'jabatan', 'trim');
		$this->form_validation->set_rules('lama_kerja', 'lama kerja', 'trim');
		$this->form_validation->set_rules('alamat_kantor', 'alamat kantor', 'trim');
		$this->form_validation->set_rules('kode_pos_kantor', 'kode pos kantor', 'trim');
		$this->form_validation->set_rules('telepon_kantor', 'telepon kantor', 'trim');
		$this->form_validation->set_rules('faksimili_kantor', 'faksimili kantor', 'trim');
		$this->form_validation->set_rules('kantor_sebelumnya', 'kantor sebelumnya', 'trim');
		$this->form_validation->set_rules('pendapatan_pertahun', 'pendapatan pertahun', 'trim|required');
		$this->form_validation->set_rules('lokasi_rumah', 'lokasi rumah', 'trim|required');
		$this->form_validation->set_rules('njob', 'njob', 'trim|required');
		$this->form_validation->set_rules('deposit_bank', 'deposit bank', 'trim|required');
		$this->form_validation->set_rules('jumlah_kekayaan', 'jumlah kekayaan', 'trim|required');
		$this->form_validation->set_rules('kekayaan_lainnya', 'kekayaan lainnya', 'trim|required');

		$this->form_validation->set_rules('pict_identitas', 'pict identitas', 'callback_validate_identitas');
		$this->form_validation->set_rules('foto_terkini', 'foto terkini', 'callback_validate_foto');
		$this->form_validation->set_rules('foto_npwp', 'foto npwp', 'callback_validate_npwp');
		$this->form_validation->set_rules('foto_buku_tabungan', 'foto buku tabungan', 'callback_validate_bukutabungan');

		$this->form_validation->set_rules('nama_bank', 'nama bank', 'trim|required');
		$this->form_validation->set_rules('no_rekening', 'No Rek', 'trim|required');
		$this->form_validation->set_rules('cabang', 'Cabang', 'trim|required');
		$this->form_validation->set_rules('jenis_rekening', 'Jenis Rekening', 'trim|required');
		$this->form_validation->set_rules('telepon_bank', 'Telepon Bank', 'trim|required');
		$this->form_validation->set_rules('kode_bank', 'Kode Bank', 'trim|required');
		$this->form_validation->set_rules('atas_nama', 'Atas Nama', 'trim|required');
		$this->form_validation->set_rules('nama_bank2', 'Nama Bank USD', 'trim|required');
		$this->form_validation->set_rules('no_rekening2', 'NO Rek USD', 'trim|required');
		$this->form_validation->set_rules('cabang2', 'Cabang USD', 'trim|required');
		$this->form_validation->set_rules('jenis_rekening2', 'Jenis Rek USD', 'trim|required');
		$this->form_validation->set_rules('telepon_bank2', 'Telepon Bank USD', 'trim|required');
		$this->form_validation->set_rules('kode_bank2', 'Kode Bank USD', 'trim|required');
		$this->form_validation->set_rules('atas_nama2', 'Atas Nama USD', 'trim|required');


		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
				'gender' => $this->input->post('gender',TRUE),
				'no_hp' => $this->input->post('no_hp',TRUE),
				'email' => $this->input->post('email',TRUE),
				'password' => $this->input->post('password',TRUE),
				'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
				'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
				'alamat_rumah' => $this->input->post('alamat_rumah',TRUE),
				'kode_pos' => $this->input->post('kode_pos',TRUE),
				'jenis_identitas' => $this->input->post('jenis_identitas',TRUE),
				'no_identitas' => $this->input->post('no_identitas',TRUE),
				'status_kawin' => $this->input->post('status_kawin',TRUE),
				'nama_pasangan' => $this->input->post('nama_pasangan',TRUE),
				'nama_ibu' => $this->input->post('nama_ibu',TRUE),
				'no_tlp' => $this->input->post('no_tlp',TRUE),
				'no_faksimili' => $this->input->post('no_faksimili',TRUE),
				'no_npwp' => $this->input->post('no_npwp',TRUE),
				'status_rumah' => $this->input->post('status_rumah',TRUE),
				'pengalaman_investasi' => $this->input->post('pengalaman_investasi',TRUE),
				'kewarganegaraan' => $this->input->post('kewarganegaraan',TRUE),
				'tujuan_pembukaan_rek' => $this->input->post('tujuan_pembukaan_rek',TRUE),
				'keluarga_bapepti' => $this->input->post('keluarga_bapepti',TRUE),
				'status_pailit' => $this->input->post('status_pailit',TRUE),
				'nama_rekan' => $this->input->post('nama_rekan',TRUE),
				'telepon_rekan' => $this->input->post('telepon_rekan',TRUE),
				'hubungan_rekan' => $this->input->post('hubungan_rekan',TRUE),
				'alamat_rekan' => $this->input->post('alamat_rekan',TRUE),
				'kode_pos_rekan' => $this->input->post('kode_pos_rekan',TRUE),
				'pekerjaan' => $this->input->post('pekerjaan',TRUE),
				'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
				'bidang_usaha' => $this->input->post('bidang_usaha',TRUE),
				'jabatan' => $this->input->post('jabatan',TRUE),
				'lama_kerja' => $this->input->post('lama_kerja',TRUE),
				'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
				'kode_pos_kantor' => $this->input->post('kode_pos_kantor',TRUE),
				'telepon_kantor' => $this->input->post('telepon_kantor',TRUE),
				'faksimili_kantor' => $this->input->post('faksimili_kantor',TRUE),
				'kantor_sebelumnya' => $this->input->post('kantor_sebelumnya',TRUE),
				'pendapatan_pertahun' => $this->input->post('pendapatan_pertahun',TRUE),
				'lokasi_rumah' => $this->input->post('lokasi_rumah',TRUE),
				'njob' => $this->input->post('njob',TRUE),
				'deposit_bank' => $this->input->post('deposit_bank',TRUE),
				'jumlah_kekayaan' => $this->input->post('jumlah_kekayaan',TRUE),
				'kekayaan_lainnya' => $this->input->post('kekayaan_lainnya',TRUE),

				'foto_npwp' => $_POST['foto_npwp'],
				'foto_buku_tabungan' => $_POST['foto_buku_tabungan'],
				'pict_identitas' => $_POST['pict_identitas'],
				'foto_terkini' => $_POST['foto_terkini'],


				'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT),

				'status' => 'Approved',
				'status_verify' => 'Y',
				'nasabah_role_id' => 2,
				'is_active' => 1,
				'created_date' => date('Y-m-d h:i:s')
			);

			$nasabah = $this->Nasabah_model->insert($data);

			$bankIDR = array(
				'nasabah_id' => $nasabah,
				'nama_bank' => $this->input->post('nama_bank',TRUE),
				'no_rekening' => $this->input->post('no_rekening',TRUE),
				'cabang' => $this->input->post('cabang',TRUE),
				'jenis_rekening' => $this->input->post('jenis_rekening',TRUE),
				'telepon_bank' => $this->input->post('telepon_bank',TRUE),
				'kode_bank' => $this->input->post('kode_bank',TRUE),
				'atas_nama' => $this->input->post('atas_nama',TRUE),
				'created_date' => date('Y-m-d h:i:s'),
				'status_bank' => 'Approve',
				'currency' => 'IDR',
			);
			$this->Bank_model->insert($bankIDR);

			$bankUSD = array(
				'nasabah_id' => $nasabah,
				'nama_bank' => $this->input->post('nama_bank2',TRUE),
				'no_rekening' => $this->input->post('no_rekening2',TRUE),
				'cabang' => $this->input->post('cabang2',TRUE),
				'jenis_rekening' => $this->input->post('jenis_rekening2',TRUE),
				'telepon_bank' => $this->input->post('telepon_bank2',TRUE),
				'kode_bank' => $this->input->post('kode_bank2',TRUE),
				'atas_nama' => $this->input->post('atas_nama2',TRUE),
				'created_date' => date('Y-m-d h:i:s'),
				'status_bank' => 'Approve',
				'currency' => 'USD',
			);
			$this->Bank_model->insert($bankUSD);

			//menyimpan log
			$dataLog = array('user_id' => $user->id,
				'nasabah_id' => $nasabah,
				'type' => 'Nasabah',
				'read_status' => 'Y',
				'aktifitas' => 'Create New Nasabah' );
			$this->Log_model->insert_admin($dataLog);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('adminarea/nasabah'));
		}
	}

	public function validate_bukutabungan() {
		$config['upload_path'] = './uploads/photo/';
		// $config['max_size'] = 1024 * 10;
		$config['allowed_types'] = 'gif|png|jpg|jpeg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if(isset($_FILES['foto_buku_tabungan']) && !empty($_FILES['foto_buku_tabungan']['name']))
		{
			if($this->upload->do_upload('foto_buku_tabungan'))
			{
				$upload_data = $this->upload->data();
				$_POST['foto_buku_tabungan'] = $upload_data['file_name'];
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('validate_npwp', $this->upload->display_errors());
				echo $this->upload->display_errors();
				die();
				return FALSE;

			}
		}
		else
		{
			$_POST['foto_buku_tabungan'] = NULL;
			return FALSE;
		}
	}

	public function validate_npwp() {
		$config['upload_path'] = './uploads/photo/';
		// $config['max_size'] = 1024 * 10;
		$config['allowed_types'] = 'gif|png|jpg|jpeg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if(isset($_FILES['foto_npwp']) && !empty($_FILES['foto_npwp']['name']))
		{
			if($this->upload->do_upload('foto_npwp'))
			{
				$upload_data = $this->upload->data();
				$_POST['foto_npwp'] = $upload_data['file_name'];
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('validate_npwp', $this->upload->display_errors());
				echo $this->upload->display_errors();
				die();
				return FALSE;

			}
		}
		else
		{
			$_POST['foto_npwp'] = NULL;
			return FALSE;
		}
	}

	public function validate_foto() {
		$config['upload_path'] = './uploads/photo/';
		// $config['max_size'] = 1024 * 10;
		$config['allowed_types'] = 'gif|png|jpg|jpeg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if(isset($_FILES['foto_terkini']) && !empty($_FILES['foto_terkini']['name']))
		{
			if($this->upload->do_upload('foto_terkini'))
			{
				$upload_data = $this->upload->data();
				$_POST['foto_terkini'] = $upload_data['file_name'];
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('validate_foto', $this->upload->display_errors());
				echo $this->upload->display_errors();
				die();
				return FALSE;

			}
		}
		else
		{
			$_POST['foto_terkini'] = NULL;
			return FALSE;
		}
	}

	public function validate_identitas() {
		$config['upload_path'] = './uploads/photo/';
		// $config['max_size'] = 1024 * 10;
		$config['allowed_types'] = 'gif|png|jpg|jpeg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if(isset($_FILES['pict_identitas']) && !empty($_FILES['pict_identitas']['name']))
		{
			if($this->upload->do_upload('pict_identitas'))
			{
				$upload_data = $this->upload->data();
				$_POST['pict_identitas'] = $upload_data['file_name'];
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('validate_identitas', $this->upload->display_errors());
				echo $this->upload->display_errors();
				die();
				return FALSE;

			}
		}
		else
		{
			$_POST['pict_identitas'] = NULL;
			return FALSE;
		}
	}

	public function update($id)
	{
		$row = $this->Nasabah_model->get_by_id($id);

		$idr = $this->Bank_model->get_last_where_IDR($id);

		$usd = $this->Bank_model->get_last_where_USD($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('adminarea/nasabah/update_action'),
				'nasabah_id' => set_value('nasabah_id', $row->nasabah_id),
				'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
				'gender' => set_value('gender', $row->gender),
				'no_hp' => set_value('no_hp', $row->no_hp),
				'email' => set_value('email', $row->email),
				'password' => set_value('password', $row->password),
				'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
				'tgl_lahir' => set_value('tgl_lahir', $row->tgl_lahir),
				'alamat_rumah' => set_value('alamat_rumah', $row->alamat_rumah),
				'kode_pos' => set_value('kode_pos', $row->kode_pos),
				'jenis_identitas' => set_value('jenis_identitas', $row->jenis_identitas),
				'no_identitas' => set_value('no_identitas', $row->no_identitas),
				'status_kawin' => set_value('status_kawin', $row->status_kawin),
				'nama_pasangan' => set_value('nama_pasangan', $row->nama_pasangan),
				'nama_ibu' => set_value('nama_ibu', $row->nama_ibu),
				'no_tlp' => set_value('no_tlp', $row->no_tlp),
				'no_faksimili' => set_value('no_faksimili', $row->no_faksimili),
				'no_npwp' => set_value('no_npwp', $row->no_npwp),
				'alamat_surat_menyurat' => set_value('alamat_surat_menyurat', $row->alamat_surat_menyurat),
				'status_rumah' => set_value('status_rumah', $row->status_rumah),
				'pengalaman_investasi' => set_value('pengalaman_investasi', $row->pengalaman_investasi),
				'kewarganegaraan' => set_value('kewarganegaraan', $row->kewarganegaraan),
				'tujuan_pembukaan_rek' => set_value('tujuan_pembukaan_rek', $row->tujuan_pembukaan_rek),
				'keluarga_bapepti' => set_value('keluarga_bapepti', $row->keluarga_bapepti),
				'status_pailit' => set_value('status_pailit', $row->status_pailit),
				'nama_rekan' => set_value('nama_rekan', $row->nama_rekan),
				'telepon_rekan' => set_value('telepon_rekan', $row->telepon_rekan),
				'hubungan_rekan' => set_value('hubungan_rekan', $row->hubungan_rekan),
				'alamat_rekan' => set_value('alamat_rekan', $row->alamat_rekan),
				'kode_pos_rekan' => set_value('kode_pos_rekan', $row->kode_pos_rekan),
				'pekerjaan' => set_value('pekerjaan', $row->pekerjaan),
				'nama_perusahaan' => set_value('nama_perusahaan', $row->nama_perusahaan),
				'bidang_usaha' => set_value('bidang_usaha', $row->bidang_usaha),
				'jabatan' => set_value('jabatan', $row->jabatan),
				'lama_kerja' => set_value('lama_kerja', $row->lama_kerja),
				'alamat_kantor' => set_value('alamat_kantor', $row->alamat_kantor),
				'kode_pos_kantor' => set_value('kode_pos_kantor', $row->kode_pos_kantor),
				'telepon_kantor' => set_value('telepon_kantor', $row->telepon_kantor),
				'faksimili_kantor' => set_value('faksimili_kantor', $row->faksimili_kantor),
				'kantor_sebelumnya' => set_value('kantor_sebelumnya', $row->kantor_sebelumnya),
				'pendapatan_pertahun' => set_value('pendapatan_pertahun', $row->pendapatan_pertahun),
				'lokasi_rumah' => set_value('lokasi_rumah', $row->lokasi_rumah),
				'njob' => set_value('njob', $row->njob),
				'deposit_bank' => set_value('deposit_bank', $row->deposit_bank),
				'jumlah_kekayaan' => set_value('jumlah_kekayaan', $row->jumlah_kekayaan),
				'kekayaan_lainnya' => set_value('kekayaan_lainnya', $row->kekayaan_lainnya),
				'pict_identitas' => set_value('pict_identitas', $row->pict_identitas),
				'foto_terkini' => set_value('foto_terkini', $row->foto_terkini),
				'foto_npwp' => set_value('foto_npwp', $row->foto_npwp),
				'foto_buku_tabungan' => set_value('foto_buku_tabungan', $row->foto_buku_tabungan),
				'status' => set_value('status', $row->status),
				'komentar' => set_value('komentar', $row->komentar),

				'nama_bank' => isset($idr->nama_bank) ? $idr->nama_bank : "-",
				'no_rekening' => isset($idr->no_rekening) ? $idr->no_rekening : "-",
				'cabang' => isset($idr->cabang) ? $idr->cabang : "-",
				'jenis_rekening' => isset($idr->jenis_rekening) ? $idr->jenis_rekening : "-",
				'telepon_bank' => isset($idr->telepon_bank) ? $idr->telepon_bank : "-",
				'kode_bank' => isset($idr->kode_bank) ? $idr->kode_bank : "-",
				'atas_nama' => isset($idr->atas_nama) ? $idr->atas_nama : "-",

				'nama_bank2' => isset($usd->nama_bank) ? $usd->nama_bank : "-",
				'no_rekening2' => isset($usd->no_rekening2) ? $usd->no_rekening : "-",
				'cabang2' => isset($usd->cabang2) ? $usd->cabang : "-",
				'jenis_rekening2' => isset($usd->jenis_rekening2) ? $usd->jenis_rekening : "-",
				'telepon_bank2' => isset($usd->telepon_bank2) ? $usd->telepon_bank : "-",
				'kode_bank2' => isset($usd->kode_bank2) ? $usd->kode_bank : "-",
				'atas_nama2' => isset($usd->atas_nama2) ? $usd->atas_nama : "-",
			);
			$data['title'] = 'Nasabah';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			$data['page'] = 'nasabah/nasabah_form';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/nasabah'));
		}
	}

	public function update_action()
	{
		$user = $this->ion_auth->user()->row();

		$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
		$this->form_validation->set_rules('gender', 'gender', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
		$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
		$this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
		$this->form_validation->set_rules('alamat_rumah', 'alamat rumah', 'trim|required');
		$this->form_validation->set_rules('kode_pos', 'kode pos', 'trim|required');
		$this->form_validation->set_rules('jenis_identitas', 'jenis identitas', 'trim|required');
		$this->form_validation->set_rules('no_identitas', 'no identitas', 'trim|required');
		$this->form_validation->set_rules('status_kawin', 'status kawin', 'trim|required');
		$this->form_validation->set_rules('nama_pasangan', 'nama pasangan', 'trim');
		$this->form_validation->set_rules('nama_ibu', 'nama ibu', 'trim|required');
		$this->form_validation->set_rules('no_tlp', 'no tlp', 'trim|required');
		$this->form_validation->set_rules('no_faksimili', 'no faksimili', 'trim');
		$this->form_validation->set_rules('no_npwp', 'no npwp', 'trim|required');

		$this->form_validation->set_rules('status_rumah', 'status rumah', 'trim|required');
		$this->form_validation->set_rules('pengalaman_investasi', 'pengalaman investasi', 'trim|required');
		$this->form_validation->set_rules('kewarganegaraan', 'kewarganegaraan', 'trim|required');
		$this->form_validation->set_rules('tujuan_pembukaan_rek', 'tujuan pembukaan rek', 'trim|required');
		$this->form_validation->set_rules('keluarga_bapepti', 'keluarga bapepti', 'trim|required');
		$this->form_validation->set_rules('status_pailit', 'status pailit', 'trim|required');
		$this->form_validation->set_rules('nama_rekan', 'nama rekan', 'trim|required');
		$this->form_validation->set_rules('telepon_rekan', 'telepon rekan', 'trim|required');
		$this->form_validation->set_rules('hubungan_rekan', 'hubungan rekan', 'trim|required');
		$this->form_validation->set_rules('alamat_rekan', 'alamat rekan', 'trim|required');
		$this->form_validation->set_rules('kode_pos_rekan', 'kode pos rekan', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required');
		$this->form_validation->set_rules('nama_perusahaan', 'nama perusahaan', 'trim');
		$this->form_validation->set_rules('bidang_usaha', 'bidang usaha', 'trim');
		$this->form_validation->set_rules('jabatan', 'jabatan', 'trim');
		$this->form_validation->set_rules('lama_kerja', 'lama kerja', 'trim');
		$this->form_validation->set_rules('alamat_kantor', 'alamat kantor', 'trim');
		$this->form_validation->set_rules('kode_pos_kantor', 'kode pos kantor', 'trim');
		$this->form_validation->set_rules('telepon_kantor', 'telepon kantor', 'trim');
		$this->form_validation->set_rules('faksimili_kantor', 'faksimili kantor', 'trim');
		$this->form_validation->set_rules('kantor_sebelumnya', 'kantor sebelumnya', 'trim');
		$this->form_validation->set_rules('pendapatan_pertahun', 'pendapatan pertahun', 'trim|required');
		$this->form_validation->set_rules('lokasi_rumah', 'lokasi rumah', 'trim|required');
		$this->form_validation->set_rules('njob', 'njob', 'trim|required');
		$this->form_validation->set_rules('deposit_bank', 'deposit bank', 'trim|required');
		$this->form_validation->set_rules('jumlah_kekayaan', 'jumlah kekayaan', 'trim|required');
		$this->form_validation->set_rules('kekayaan_lainnya', 'kekayaan lainnya', 'trim');
		$this->form_validation->set_rules('status', 'status', 'trim|required');
		$this->form_validation->set_rules('komentar', 'komentar', 'trim');

		$this->form_validation->set_rules('pict_identitas', 'pict identitas', 'callback_validate_identitas2');
		$this->form_validation->set_rules('foto_terkini', 'foto terkini', 'callback_validate_foto2');
		$this->form_validation->set_rules('foto_npwp', 'foto npwp', 'callback_validate_npwp2');
		$this->form_validation->set_rules('foto_buku_tabungan', 'foto buku tabungan', 'callback_validate_bukutabungan2');

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('nasabah_id', TRUE));
		} else {
			if ($_POST['foto_npwp']!=NULL) {
				$data = array(
					'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
					'gender' => $this->input->post('gender',TRUE),
					'no_hp' => $this->input->post('no_hp',TRUE),
					// 'password' => $this->input->post('password',TRUE),
					'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
					'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
					'alamat_rumah' => $this->input->post('alamat_rumah',TRUE),
					'kode_pos' => $this->input->post('kode_pos',TRUE),
					'jenis_identitas' => $this->input->post('jenis_identitas',TRUE),
					'no_identitas' => $this->input->post('no_identitas',TRUE),
					'status_kawin' => $this->input->post('status_kawin',TRUE),
					'nama_pasangan' => $this->input->post('nama_pasangan',TRUE),
					'nama_ibu' => $this->input->post('nama_ibu',TRUE),
					'no_tlp' => $this->input->post('no_tlp',TRUE),
					'no_faksimili' => $this->input->post('no_faksimili',TRUE),
					'no_npwp' => $this->input->post('no_npwp',TRUE),
					'status_rumah' => $this->input->post('status_rumah',TRUE),
					'pengalaman_investasi' => $this->input->post('pengalaman_investasi',TRUE),
					'kewarganegaraan' => $this->input->post('kewarganegaraan',TRUE),
					'tujuan_pembukaan_rek' => $this->input->post('tujuan_pembukaan_rek',TRUE),
					'keluarga_bapepti' => $this->input->post('keluarga_bapepti',TRUE),
					'status_pailit' => $this->input->post('status_pailit',TRUE),
					'nama_rekan' => $this->input->post('nama_rekan',TRUE),
					'telepon_rekan' => $this->input->post('telepon_rekan',TRUE),
					'hubungan_rekan' => $this->input->post('hubungan_rekan',TRUE),
					'alamat_rekan' => $this->input->post('alamat_rekan',TRUE),
					'kode_pos_rekan' => $this->input->post('kode_pos_rekan',TRUE),
					'pekerjaan' => $this->input->post('pekerjaan',TRUE),
					'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
					'bidang_usaha' => $this->input->post('bidang_usaha',TRUE),
					'jabatan' => $this->input->post('jabatan',TRUE),
					'lama_kerja' => $this->input->post('lama_kerja',TRUE),
					'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
					'kode_pos_kantor' => $this->input->post('kode_pos_kantor',TRUE),
					'telepon_kantor' => $this->input->post('telepon_kantor',TRUE),
					'faksimili_kantor' => $this->input->post('faksimili_kantor',TRUE),
					'kantor_sebelumnya' => $this->input->post('kantor_sebelumnya',TRUE),
					'pendapatan_pertahun' => $this->input->post('pendapatan_pertahun',TRUE),
					'lokasi_rumah' => $this->input->post('lokasi_rumah',TRUE),
					'njob' => $this->input->post('njob',TRUE),
					'deposit_bank' => $this->input->post('deposit_bank',TRUE),
					'jumlah_kekayaan' => $this->input->post('jumlah_kekayaan',TRUE),
					'kekayaan_lainnya' => $this->input->post('kekayaan_lainnya',TRUE),
					'status' => $this->input->post('status',TRUE),
					'komentar' => $this->input->post('komentar',TRUE),

					'foto_npwp' => $_POST['foto_npwp'],

					'update_date' => date('Y-m-d h:i:s'),
					'update_user_id' => $user->id,
				);
			} elseif ($_POST['pict_identitas']!=NULL) {
				$data = array(
					'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
					'gender' => $this->input->post('gender',TRUE),
					'no_hp' => $this->input->post('no_hp',TRUE),
					// 'password' => $this->input->post('password',TRUE),
					'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
					'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
					'alamat_rumah' => $this->input->post('alamat_rumah',TRUE),
					'kode_pos' => $this->input->post('kode_pos',TRUE),
					'jenis_identitas' => $this->input->post('jenis_identitas',TRUE),
					'no_identitas' => $this->input->post('no_identitas',TRUE),
					'status_kawin' => $this->input->post('status_kawin',TRUE),
					'nama_pasangan' => $this->input->post('nama_pasangan',TRUE),
					'nama_ibu' => $this->input->post('nama_ibu',TRUE),
					'no_tlp' => $this->input->post('no_tlp',TRUE),
					'no_faksimili' => $this->input->post('no_faksimili',TRUE),
					'no_npwp' => $this->input->post('no_npwp',TRUE),
					'status_rumah' => $this->input->post('status_rumah',TRUE),
					'pengalaman_investasi' => $this->input->post('pengalaman_investasi',TRUE),
					'kewarganegaraan' => $this->input->post('kewarganegaraan',TRUE),
					'tujuan_pembukaan_rek' => $this->input->post('tujuan_pembukaan_rek',TRUE),
					'keluarga_bapepti' => $this->input->post('keluarga_bapepti',TRUE),
					'status_pailit' => $this->input->post('status_pailit',TRUE),
					'nama_rekan' => $this->input->post('nama_rekan',TRUE),
					'telepon_rekan' => $this->input->post('telepon_rekan',TRUE),
					'hubungan_rekan' => $this->input->post('hubungan_rekan',TRUE),
					'alamat_rekan' => $this->input->post('alamat_rekan',TRUE),
					'kode_pos_rekan' => $this->input->post('kode_pos_rekan',TRUE),
					'pekerjaan' => $this->input->post('pekerjaan',TRUE),
					'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
					'bidang_usaha' => $this->input->post('bidang_usaha',TRUE),
					'jabatan' => $this->input->post('jabatan',TRUE),
					'lama_kerja' => $this->input->post('lama_kerja',TRUE),
					'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
					'kode_pos_kantor' => $this->input->post('kode_pos_kantor',TRUE),
					'telepon_kantor' => $this->input->post('telepon_kantor',TRUE),
					'faksimili_kantor' => $this->input->post('faksimili_kantor',TRUE),
					'kantor_sebelumnya' => $this->input->post('kantor_sebelumnya',TRUE),
					'pendapatan_pertahun' => $this->input->post('pendapatan_pertahun',TRUE),
					'lokasi_rumah' => $this->input->post('lokasi_rumah',TRUE),
					'njob' => $this->input->post('njob',TRUE),
					'deposit_bank' => $this->input->post('deposit_bank',TRUE),
					'jumlah_kekayaan' => $this->input->post('jumlah_kekayaan',TRUE),
					'kekayaan_lainnya' => $this->input->post('kekayaan_lainnya',TRUE),
					'status' => $this->input->post('status',TRUE),
					'komentar' => $this->input->post('komentar',TRUE),

					'pict_identitas' => $_POST['pict_identitas'],

					'update_date' => date('Y-m-d h:i:s'),
					'update_user_id' => $user->id,
				);
			} elseif ($_POST['foto_terkini']!=NULL) {
				$data = array(
					'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
					'gender' => $this->input->post('gender',TRUE),
					'no_hp' => $this->input->post('no_hp',TRUE),
					// 'password' => $this->input->post('password',TRUE),
					'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
					'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
					'alamat_rumah' => $this->input->post('alamat_rumah',TRUE),
					'kode_pos' => $this->input->post('kode_pos',TRUE),
					'jenis_identitas' => $this->input->post('jenis_identitas',TRUE),
					'no_identitas' => $this->input->post('no_identitas',TRUE),
					'status_kawin' => $this->input->post('status_kawin',TRUE),
					'nama_pasangan' => $this->input->post('nama_pasangan',TRUE),
					'nama_ibu' => $this->input->post('nama_ibu',TRUE),
					'no_tlp' => $this->input->post('no_tlp',TRUE),
					'no_faksimili' => $this->input->post('no_faksimili',TRUE),
					'no_npwp' => $this->input->post('no_npwp',TRUE),
					'status_rumah' => $this->input->post('status_rumah',TRUE),
					'pengalaman_investasi' => $this->input->post('pengalaman_investasi',TRUE),
					'kewarganegaraan' => $this->input->post('kewarganegaraan',TRUE),
					'tujuan_pembukaan_rek' => $this->input->post('tujuan_pembukaan_rek',TRUE),
					'keluarga_bapepti' => $this->input->post('keluarga_bapepti',TRUE),
					'status_pailit' => $this->input->post('status_pailit',TRUE),
					'nama_rekan' => $this->input->post('nama_rekan',TRUE),
					'telepon_rekan' => $this->input->post('telepon_rekan',TRUE),
					'hubungan_rekan' => $this->input->post('hubungan_rekan',TRUE),
					'alamat_rekan' => $this->input->post('alamat_rekan',TRUE),
					'kode_pos_rekan' => $this->input->post('kode_pos_rekan',TRUE),
					'pekerjaan' => $this->input->post('pekerjaan',TRUE),
					'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
					'bidang_usaha' => $this->input->post('bidang_usaha',TRUE),
					'jabatan' => $this->input->post('jabatan',TRUE),
					'lama_kerja' => $this->input->post('lama_kerja',TRUE),
					'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
					'kode_pos_kantor' => $this->input->post('kode_pos_kantor',TRUE),
					'telepon_kantor' => $this->input->post('telepon_kantor',TRUE),
					'faksimili_kantor' => $this->input->post('faksimili_kantor',TRUE),
					'kantor_sebelumnya' => $this->input->post('kantor_sebelumnya',TRUE),
					'pendapatan_pertahun' => $this->input->post('pendapatan_pertahun',TRUE),
					'lokasi_rumah' => $this->input->post('lokasi_rumah',TRUE),
					'njob' => $this->input->post('njob',TRUE),
					'deposit_bank' => $this->input->post('deposit_bank',TRUE),
					'jumlah_kekayaan' => $this->input->post('jumlah_kekayaan',TRUE),
					'kekayaan_lainnya' => $this->input->post('kekayaan_lainnya',TRUE),
					'status' => $this->input->post('status',TRUE),
					'komentar' => $this->input->post('komentar',TRUE),

					'foto_terkini' => $_POST['foto_terkini'],

					'update_date' => date('Y-m-d h:i:s'),
					'update_user_id' => $user->id,
				);
			} elseif ($_POST['foto_buku_tabungan']!=NULL) {
				$data = array(
					'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
					'gender' => $this->input->post('gender',TRUE),
					'no_hp' => $this->input->post('no_hp',TRUE),
					// 'password' => $this->input->post('password',TRUE),
					'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
					'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
					'alamat_rumah' => $this->input->post('alamat_rumah',TRUE),
					'kode_pos' => $this->input->post('kode_pos',TRUE),
					'jenis_identitas' => $this->input->post('jenis_identitas',TRUE),
					'no_identitas' => $this->input->post('no_identitas',TRUE),
					'status_kawin' => $this->input->post('status_kawin',TRUE),
					'nama_pasangan' => $this->input->post('nama_pasangan',TRUE),
					'nama_ibu' => $this->input->post('nama_ibu',TRUE),
					'no_tlp' => $this->input->post('no_tlp',TRUE),
					'no_faksimili' => $this->input->post('no_faksimili',TRUE),
					'no_npwp' => $this->input->post('no_npwp',TRUE),
					'status_rumah' => $this->input->post('status_rumah',TRUE),
					'pengalaman_investasi' => $this->input->post('pengalaman_investasi',TRUE),
					'kewarganegaraan' => $this->input->post('kewarganegaraan',TRUE),
					'tujuan_pembukaan_rek' => $this->input->post('tujuan_pembukaan_rek',TRUE),
					'keluarga_bapepti' => $this->input->post('keluarga_bapepti',TRUE),
					'status_pailit' => $this->input->post('status_pailit',TRUE),
					'nama_rekan' => $this->input->post('nama_rekan',TRUE),
					'telepon_rekan' => $this->input->post('telepon_rekan',TRUE),
					'hubungan_rekan' => $this->input->post('hubungan_rekan',TRUE),
					'alamat_rekan' => $this->input->post('alamat_rekan',TRUE),
					'kode_pos_rekan' => $this->input->post('kode_pos_rekan',TRUE),
					'pekerjaan' => $this->input->post('pekerjaan',TRUE),
					'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
					'bidang_usaha' => $this->input->post('bidang_usaha',TRUE),
					'jabatan' => $this->input->post('jabatan',TRUE),
					'lama_kerja' => $this->input->post('lama_kerja',TRUE),
					'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
					'kode_pos_kantor' => $this->input->post('kode_pos_kantor',TRUE),
					'telepon_kantor' => $this->input->post('telepon_kantor',TRUE),
					'faksimili_kantor' => $this->input->post('faksimili_kantor',TRUE),
					'kantor_sebelumnya' => $this->input->post('kantor_sebelumnya',TRUE),
					'pendapatan_pertahun' => $this->input->post('pendapatan_pertahun',TRUE),
					'lokasi_rumah' => $this->input->post('lokasi_rumah',TRUE),
					'njob' => $this->input->post('njob',TRUE),
					'deposit_bank' => $this->input->post('deposit_bank',TRUE),
					'jumlah_kekayaan' => $this->input->post('jumlah_kekayaan',TRUE),
					'kekayaan_lainnya' => $this->input->post('kekayaan_lainnya',TRUE),
					'status' => $this->input->post('status',TRUE),
					'komentar' => $this->input->post('komentar',TRUE),

					'foto_buku_tabungan' => $_POST['foto_buku_tabungan'],

					'update_date' => date('Y-m-d h:i:s'),
					'update_user_id' => $user->id,
				);
			} elseif ($_POST['foto_terkini']!=NULL && $_POST['pict_identitas']!=NULL && $_POST['dokumen_tambahan']!=NULL && $_POST['foto_buku_tabungan']!=NULL) {
				$data = array(
					'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
					'gender' => $this->input->post('gender',TRUE),
					'no_hp' => $this->input->post('no_hp',TRUE),
					// 'password' => $this->input->post('password',TRUE),
					'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
					'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
					'alamat_rumah' => $this->input->post('alamat_rumah',TRUE),
					'kode_pos' => $this->input->post('kode_pos',TRUE),
					'jenis_identitas' => $this->input->post('jenis_identitas',TRUE),
					'no_identitas' => $this->input->post('no_identitas',TRUE),
					'status_kawin' => $this->input->post('status_kawin',TRUE),
					'nama_pasangan' => $this->input->post('nama_pasangan',TRUE),
					'nama_ibu' => $this->input->post('nama_ibu',TRUE),
					'no_tlp' => $this->input->post('no_tlp',TRUE),
					'no_faksimili' => $this->input->post('no_faksimili',TRUE),
					'no_npwp' => $this->input->post('no_npwp',TRUE),
					'status_rumah' => $this->input->post('status_rumah',TRUE),
					'pengalaman_investasi' => $this->input->post('pengalaman_investasi',TRUE),
					'kewarganegaraan' => $this->input->post('kewarganegaraan',TRUE),
					'tujuan_pembukaan_rek' => $this->input->post('tujuan_pembukaan_rek',TRUE),
					'keluarga_bapepti' => $this->input->post('keluarga_bapepti',TRUE),
					'status_pailit' => $this->input->post('status_pailit',TRUE),
					'nama_rekan' => $this->input->post('nama_rekan',TRUE),
					'telepon_rekan' => $this->input->post('telepon_rekan',TRUE),
					'hubungan_rekan' => $this->input->post('hubungan_rekan',TRUE),
					'alamat_rekan' => $this->input->post('alamat_rekan',TRUE),
					'kode_pos_rekan' => $this->input->post('kode_pos_rekan',TRUE),
					'pekerjaan' => $this->input->post('pekerjaan',TRUE),
					'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
					'bidang_usaha' => $this->input->post('bidang_usaha',TRUE),
					'jabatan' => $this->input->post('jabatan',TRUE),
					'lama_kerja' => $this->input->post('lama_kerja',TRUE),
					'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
					'kode_pos_kantor' => $this->input->post('kode_pos_kantor',TRUE),
					'telepon_kantor' => $this->input->post('telepon_kantor',TRUE),
					'faksimili_kantor' => $this->input->post('faksimili_kantor',TRUE),
					'kantor_sebelumnya' => $this->input->post('kantor_sebelumnya',TRUE),
					'pendapatan_pertahun' => $this->input->post('pendapatan_pertahun',TRUE),
					'lokasi_rumah' => $this->input->post('lokasi_rumah',TRUE),
					'njob' => $this->input->post('njob',TRUE),
					'deposit_bank' => $this->input->post('deposit_bank',TRUE),
					'jumlah_kekayaan' => $this->input->post('jumlah_kekayaan',TRUE),
					'kekayaan_lainnya' => $this->input->post('kekayaan_lainnya',TRUE),
					'status' => $this->input->post('status',TRUE),
					'komentar' => $this->input->post('komentar',TRUE),

					'foto_terkini' => $_POST['foto_terkini'],
					'pict_identitas' => $_POST['pict_identitas'],
					'foto_npwp' => $_POST['foto_npwp'],
					'foto_buku_tabungan' => $_POST['foto_buku_tabungan'],

					'update_date' => date('Y-m-d h:i:s'),
					'update_user_id' => $user->id,
				);
			} else {
				$data = array(
					'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
					'gender' => $this->input->post('gender',TRUE),
					'no_hp' => $this->input->post('no_hp',TRUE),
					// 'password' => $this->input->post('password',TRUE),
					'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
					'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
					'alamat_rumah' => $this->input->post('alamat_rumah',TRUE),
					'kode_pos' => $this->input->post('kode_pos',TRUE),
					'jenis_identitas' => $this->input->post('jenis_identitas',TRUE),
					'no_identitas' => $this->input->post('no_identitas',TRUE),
					'status_kawin' => $this->input->post('status_kawin',TRUE),
					'nama_pasangan' => $this->input->post('nama_pasangan',TRUE),
					'nama_ibu' => $this->input->post('nama_ibu',TRUE),
					'no_tlp' => $this->input->post('no_tlp',TRUE),
					'no_faksimili' => $this->input->post('no_faksimili',TRUE),
					'no_npwp' => $this->input->post('no_npwp',TRUE),
					'status_rumah' => $this->input->post('status_rumah',TRUE),
					'pengalaman_investasi' => $this->input->post('pengalaman_investasi',TRUE),
					'kewarganegaraan' => $this->input->post('kewarganegaraan',TRUE),
					'tujuan_pembukaan_rek' => $this->input->post('tujuan_pembukaan_rek',TRUE),
					'keluarga_bapepti' => $this->input->post('keluarga_bapepti',TRUE),
					'status_pailit' => $this->input->post('status_pailit',TRUE),
					'nama_rekan' => $this->input->post('nama_rekan',TRUE),
					'telepon_rekan' => $this->input->post('telepon_rekan',TRUE),
					'hubungan_rekan' => $this->input->post('hubungan_rekan',TRUE),
					'alamat_rekan' => $this->input->post('alamat_rekan',TRUE),
					'kode_pos_rekan' => $this->input->post('kode_pos_rekan',TRUE),
					'pekerjaan' => $this->input->post('pekerjaan',TRUE),
					'nama_perusahaan' => $this->input->post('nama_perusahaan',TRUE),
					'bidang_usaha' => $this->input->post('bidang_usaha',TRUE),
					'jabatan' => $this->input->post('jabatan',TRUE),
					'lama_kerja' => $this->input->post('lama_kerja',TRUE),
					'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
					'kode_pos_kantor' => $this->input->post('kode_pos_kantor',TRUE),
					'telepon_kantor' => $this->input->post('telepon_kantor',TRUE),
					'faksimili_kantor' => $this->input->post('faksimili_kantor',TRUE),
					'kantor_sebelumnya' => $this->input->post('kantor_sebelumnya',TRUE),
					'pendapatan_pertahun' => $this->input->post('pendapatan_pertahun',TRUE),
					'lokasi_rumah' => $this->input->post('lokasi_rumah',TRUE),
					'njob' => $this->input->post('njob',TRUE),
					'deposit_bank' => $this->input->post('deposit_bank',TRUE),
					'jumlah_kekayaan' => $this->input->post('jumlah_kekayaan',TRUE),
					'kekayaan_lainnya' => $this->input->post('kekayaan_lainnya',TRUE),
					'status' => $this->input->post('status',TRUE),
					'komentar' => $this->input->post('komentar',TRUE),
					'update_date' => date('Y-m-d h:i:s'),
					'update_user_id' => $user->id,
				);
			}
			$this->Nasabah_model->update($this->input->post('nasabah_id', TRUE), $data);

			$bankUSD = $this->Bank_model->get_last_where_USD($this->input->post('nasabah_id',TRUE));
			$bankIDR = $this->Bank_model->get_last_where_IDR($this->input->post('nasabah_id',TRUE));

			if ($this->input->post('status',TRUE)=='Approved') {
				$dataBank = array('status_bank' => 'Approve',
					'update_date' => date('Y-m-d h:i:s'));

				if (!empty($bankIDR)) {
					$this->Bank_model->update($bankIDR->bank_id, $dataBank);
				}

				if (!empty($bankUSD)) {
					$this->Bank_model->update($bankUSD->bank_id, $dataBank);
				}

				$dataReq = $this->Acc_request_model->get_last_by_id_nasabah($this->input->post('nasabah_id', TRUE));
				$request = array('status_request' => 'Disetujui');
				$this->Acc_request_model->update($dataReq->acc_request_id, $request);
			} elseif ($this->input->post('status',TRUE)=='Checking') {
				$this->_sendEmail($this->input->post('email',TRUE), 'Data Diri Belum Lengkap', $this->input->post('komentar',TRUE));

				$dataEmail = array(
					'nasabah_id' => $this->input->post('nasabah_id', TRUE),
					'subject' => 'Data Diri Belum Lengkap',
					'isi' => $this->input->post('komentar',TRUE),
					'user_id' => $user->id
				);
				$this->Users_pesan_model->insert($dataEmail);
			}

			//menyimpan log
			$dataLog = array('user_id' => $user->id,
				'nasabah_id' => $this->input->post('nasabah_id', TRUE),
				'type' => 'Nasabah',
				'read_status' => 'Y',
				'aktifitas' => 'Update data Nasabah ' );
			$this->Log_model->insert_admin($dataLog);

			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('adminarea/nasabah'));

		}
	}

	private function _sendEmail($email, $subject, $pesan) {
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
		$this->load->library('email', $config);

		// Email dan nama pengirim
		$this->email->from('support@tifia.co.id', 'PT. Tifia Finansial Berjangka');

		// Email penerima
		$this->email->to($email); // Ganti dengan email tujuan kamu

		// Subject email
		$this->email->subject($subject);

		// Isi email
		$this->email->message($pesan);

		// $this->email->message('huu');

		// Tampilkan pesan sukses atau error
		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die();
		}
	}

	public function validate_bukutabungan2() {
		$config['upload_path'] = './uploads/photo/';
		// $config['max_size'] = 1024 * 10;
		$config['allowed_types'] = 'gif|png|jpg|jpeg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if(isset($_FILES['foto_buku_tabungan']) && !empty($_FILES['foto_buku_tabungan']['name']))
		{
			if($this->upload->do_upload('foto_buku_tabungan'))
			{
				$upload_data = $this->upload->data();
				$_POST['foto_buku_tabungan'] = $upload_data['file_name'];
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('validate_npwp', $this->upload->display_errors());
				echo $this->upload->display_errors();
				die();
				return FALSE;

			}
		}
		else
		{
			$_POST['foto_buku_tabungan'] = NULL;
			return TRUE;
		}
	}

	public function validate_npwp2() {
		$config['upload_path'] = './uploads/photo/';
		// $config['max_size'] = 1024 * 10;
		$config['allowed_types'] = 'gif|png|jpg|jpeg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if(isset($_FILES['foto_npwp']) && !empty($_FILES['foto_npwp']['name']))
		{
			if($this->upload->do_upload('foto_npwp'))
			{
				$upload_data = $this->upload->data();
				$_POST['foto_npwp'] = $upload_data['file_name'];
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('validate_npwp', $this->upload->display_errors());
				echo $this->upload->display_errors();
				die();
				return FALSE;

			}
		}
		else
		{
			$_POST['foto_npwp'] = NULL;
			return TRUE;
		}
	}

	public function validate_foto2() {
		$config['upload_path'] = './uploads/photo/';
		// $config['max_size'] = 1024 * 10;
		$config['allowed_types'] = 'gif|png|jpg|jpeg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if(isset($_FILES['foto_terkini']) && !empty($_FILES['foto_terkini']['name']))
		{
			if($this->upload->do_upload('foto_terkini'))
			{
				$upload_data = $this->upload->data();
				$_POST['foto_terkini'] = $upload_data['file_name'];
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('validate_foto', $this->upload->display_errors());
				echo $this->upload->display_errors();
				die();
				return FALSE;

			}
		}
		else
		{
			$_POST['foto_terkini'] = NULL;
			return TRUE;
		}
	}

	public function validate_identitas2() {
		$config['upload_path'] = './uploads/photo/';
		// $config['max_size'] = 1024 * 10;
		$config['allowed_types'] = 'gif|png|jpg|jpeg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if(isset($_FILES['pict_identitas']) && !empty($_FILES['pict_identitas']['name']))
		{
			if($this->upload->do_upload('pict_identitas'))
			{
				$upload_data = $this->upload->data();
				$_POST['pict_identitas'] = $upload_data['file_name'];
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('validate_identitas', $this->upload->display_errors());
				echo $this->upload->display_errors();
				die();
				return FALSE;

			}
		}
		else
		{
			$_POST['pict_identitas'] = NULL;
			return TRUE;
		}
	}

	public function delete($id)
	{
		$row = $this->Nasabah_model->get_by_id($id);

		if ($row) {
			$this->Nasabah_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('adminarea/nasabah'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/nasabah'));
		}
	}

	public function deletebulk(){
		$delete = $this->Nasabah_model->deletebulk();
		if($delete){
			$this->session->set_flashdata('message', 'Delete Record Success');
		}else{
			$this->session->set_flashdata('message_error', 'Delete Record failed');
		}
		echo $delete;
	}

	public function _rules() {
		$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
		$this->form_validation->set_rules('gender', 'gender', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
		$this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
		$this->form_validation->set_rules('alamat_rumah', 'alamat rumah', 'trim|required');
		$this->form_validation->set_rules('kode_pos', 'kode pos', 'trim|required');
		$this->form_validation->set_rules('jenis_identitas', 'jenis identitas', 'trim|required');
		$this->form_validation->set_rules('no_identitas', 'no identitas', 'trim|required');
		$this->form_validation->set_rules('status_kawin', 'status kawin', 'trim|required');
		$this->form_validation->set_rules('nama_ibu', 'nama ibu', 'trim|required');
		$this->form_validation->set_rules('no_tlp', 'no tlp', 'trim|required');
		$this->form_validation->set_rules('no_faksimili', 'no faksimili', 'trim|required');
		$this->form_validation->set_rules('no_npwp', 'no npwp', 'trim|required');
		$this->form_validation->set_rules('status_rumah', 'status rumah', 'trim|required');
		$this->form_validation->set_rules('pengalaman_investasi', 'pengalaman investasi', 'trim|required');
		$this->form_validation->set_rules('kewarganegaraan', 'kewarganegaraan', 'trim|required');
		$this->form_validation->set_rules('tujuan_pembukaan_rek', 'tujuan pembukaan rek', 'trim|required');
		$this->form_validation->set_rules('keluarga_bapepti', 'keluarga bapepti', 'trim|required');
		$this->form_validation->set_rules('status_pailit', 'status pailit', 'trim|required');
		$this->form_validation->set_rules('nama_rekan', 'nama rekan', 'trim|required');
		$this->form_validation->set_rules('telepon_rekan', 'telepon rekan', 'trim|required');
		$this->form_validation->set_rules('hubungan_rekan', 'hubungan rekan', 'trim|required');
		$this->form_validation->set_rules('alamat_rekan', 'alamat rekan', 'trim|required');
		$this->form_validation->set_rules('kode_pos_rekan', 'kode pos rekan', 'trim|required');
		$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required');
		$this->form_validation->set_rules('nama_perusahaan', 'nama perusahaan', 'trim');
		$this->form_validation->set_rules('bidang_usaha', 'bidang usaha', 'trim');
		$this->form_validation->set_rules('jabatan', 'jabatan', 'trim');
		$this->form_validation->set_rules('lama_kerja', 'lama kerja', 'trim');
		$this->form_validation->set_rules('alamat_kantor', 'alamat kantor', 'trim');
		$this->form_validation->set_rules('kode_pos_kantor', 'kode pos kantor', 'trim');
		$this->form_validation->set_rules('telepon_kantor', 'telepon kantor', 'trim');
		$this->form_validation->set_rules('faksimili_kantor', 'faksimili kantor', 'trim');
		$this->form_validation->set_rules('kantor_sebelumnya', 'kantor sebelumnya', 'trim');
		$this->form_validation->set_rules('pendapatan_pertahun', 'pendapatan pertahun', 'trim|required');
		$this->form_validation->set_rules('lokasi_rumah', 'lokasi rumah', 'trim|required');
		$this->form_validation->set_rules('njob', 'njob', 'trim|required');
		$this->form_validation->set_rules('deposit_bank', 'deposit bank', 'trim|required');
		$this->form_validation->set_rules('jumlah_kekayaan', 'jumlah kekayaan', 'trim|required');
		$this->form_validation->set_rules('kekayaan_lainnya', 'kekayaan lainnya', 'trim|required');
		$this->form_validation->set_rules('pict_identitas', 'pict identitas', 'trim|required');
		$this->form_validation->set_rules('foto_terkini', 'foto terkini', 'trim|required');
		$this->form_validation->set_rules('jenis_dokumen_tambahan', 'jenis dokumen tambahan', 'trim|required');
		$this->form_validation->set_rules('dokumen_tambahan', 'dokumen tambahan', 'trim|required');
		$this->form_validation->set_rules('perusahaan_simulasi', 'perusahaan simulasi', 'trim|required');
		$this->form_validation->set_rules('penyelesaian_perselisihan', 'penyelesaian perselisihan', 'trim|required');
		$this->form_validation->set_rules('daftar_kantor', 'daftar kantor', 'trim|required');
		$this->form_validation->set_rules('status', 'status', 'trim|required');
		$this->form_validation->set_rules('komentar', 'komentar', 'trim');

		$this->form_validation->set_rules('nasabah_id', 'nasabah_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "nasabah.xls";
		$judul = "nasabah";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Lengkap");
		xlsWriteLabel($tablehead, $kolomhead++, "Gender");
		xlsWriteLabel($tablehead, $kolomhead++, "No Hp");
		xlsWriteLabel($tablehead, $kolomhead++, "Email");
		xlsWriteLabel($tablehead, $kolomhead++, "Password");
		xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
		xlsWriteLabel($tablehead, $kolomhead++, "Tgl Lahir");
		xlsWriteLabel($tablehead, $kolomhead++, "Alamat Rumah");
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Pos");
		xlsWriteLabel($tablehead, $kolomhead++, "Jenis Identitas");
		xlsWriteLabel($tablehead, $kolomhead++, "No Identitas");
		xlsWriteLabel($tablehead, $kolomhead++, "Status Kawin");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Pasangan");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Ibu");
		xlsWriteLabel($tablehead, $kolomhead++, "No Tlp");
		xlsWriteLabel($tablehead, $kolomhead++, "No Faksimili");
		xlsWriteLabel($tablehead, $kolomhead++, "No Npwp");
		xlsWriteLabel($tablehead, $kolomhead++, "Alamat Surat Menyurat");
		xlsWriteLabel($tablehead, $kolomhead++, "Status Rumah");
		xlsWriteLabel($tablehead, $kolomhead++, "Pengalaman Investasi");
		xlsWriteLabel($tablehead, $kolomhead++, "Kewarganegaraan");
		xlsWriteLabel($tablehead, $kolomhead++, "Tujuan Pembukaan Rek");
		xlsWriteLabel($tablehead, $kolomhead++, "Keluarga Bapepti");
		xlsWriteLabel($tablehead, $kolomhead++, "Status Pailit");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Rekan");
		xlsWriteLabel($tablehead, $kolomhead++, "Telepon Rekan");
		xlsWriteLabel($tablehead, $kolomhead++, "Hubungan Rekan");
		xlsWriteLabel($tablehead, $kolomhead++, "Alamat Rekan");
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Pos Rekan");
		xlsWriteLabel($tablehead, $kolomhead++, "Pekerjaan");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Perusahaan");
		xlsWriteLabel($tablehead, $kolomhead++, "Bidang Usaha");
		xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
		xlsWriteLabel($tablehead, $kolomhead++, "Lama Kerja");
		xlsWriteLabel($tablehead, $kolomhead++, "Alamat Kantor");
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Pos Kantor");
		xlsWriteLabel($tablehead, $kolomhead++, "Telepon Kantor");
		xlsWriteLabel($tablehead, $kolomhead++, "Faksimili Kantor");
		xlsWriteLabel($tablehead, $kolomhead++, "Kantor Sebelumnya");
		xlsWriteLabel($tablehead, $kolomhead++, "Pendapatan Pertahun");
		xlsWriteLabel($tablehead, $kolomhead++, "Lokasi Rumah");
		xlsWriteLabel($tablehead, $kolomhead++, "Njob");
		xlsWriteLabel($tablehead, $kolomhead++, "Deposit Bank");
		xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Kekayaan");
		xlsWriteLabel($tablehead, $kolomhead++, "Kekayaan Lainnya");
		xlsWriteLabel($tablehead, $kolomhead++, "Pict Identitas");
		xlsWriteLabel($tablehead, $kolomhead++, "Foto Terkini");
		xlsWriteLabel($tablehead, $kolomhead++, "Jenis Dokumen Tambahan");
		xlsWriteLabel($tablehead, $kolomhead++, "Dokumen Tambahan");
		xlsWriteLabel($tablehead, $kolomhead++, "Perusahaan Simulasi");
		xlsWriteLabel($tablehead, $kolomhead++, "Penyelesaian Perselisihan");
		xlsWriteLabel($tablehead, $kolomhead++, "Daftar Kantor");
		xlsWriteLabel($tablehead, $kolomhead++, "Status");
		xlsWriteLabel($tablehead, $kolomhead++, "Status Verify");
		xlsWriteLabel($tablehead, $kolomhead++, "Is Active");
		xlsWriteLabel($tablehead, $kolomhead++, "Komentar");
		xlsWriteLabel($tablehead, $kolomhead++, "Nasabah Role Id");
		xlsWriteLabel($tablehead, $kolomhead++, "Created Date");
		xlsWriteLabel($tablehead, $kolomhead++, "User Id");
		xlsWriteLabel($tablehead, $kolomhead++, "Update Date");
		xlsWriteLabel($tablehead, $kolomhead++, "Update User Id");

		foreach ($this->Nasabah_model->get_all() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
			xlsWriteLabel($tablebody, $kolombody++, $data->gender);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
			xlsWriteLabel($tablebody, $kolombody++, $data->email);
			xlsWriteLabel($tablebody, $kolombody++, $data->password);
			xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
			xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lahir);
			xlsWriteLabel($tablebody, $kolombody++, $data->alamat_rumah);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode_pos);
			xlsWriteLabel($tablebody, $kolombody++, $data->jenis_identitas);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_identitas);
			xlsWriteLabel($tablebody, $kolombody++, $data->status_kawin);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_pasangan);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_ibu);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_tlp);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_faksimili);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_npwp);
			xlsWriteLabel($tablebody, $kolombody++, $data->alamat_surat_menyurat);
			xlsWriteLabel($tablebody, $kolombody++, $data->status_rumah);
			xlsWriteLabel($tablebody, $kolombody++, $data->pengalaman_investasi);
			xlsWriteLabel($tablebody, $kolombody++, $data->kewarganegaraan);
			xlsWriteLabel($tablebody, $kolombody++, $data->tujuan_pembukaan_rek);
			xlsWriteLabel($tablebody, $kolombody++, $data->keluarga_bapepti);
			xlsWriteLabel($tablebody, $kolombody++, $data->status_pailit);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_rekan);
			xlsWriteLabel($tablebody, $kolombody++, $data->telepon_rekan);
			xlsWriteLabel($tablebody, $kolombody++, $data->hubungan_rekan);
			xlsWriteLabel($tablebody, $kolombody++, $data->alamat_rekan);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode_pos_rekan);
			xlsWriteLabel($tablebody, $kolombody++, $data->pekerjaan);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_perusahaan);
			xlsWriteLabel($tablebody, $kolombody++, $data->bidang_usaha);
			xlsWriteLabel($tablebody, $kolombody++, $data->jabatan);
			xlsWriteLabel($tablebody, $kolombody++, $data->lama_kerja);
			xlsWriteLabel($tablebody, $kolombody++, $data->alamat_kantor);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode_pos_kantor);
			xlsWriteLabel($tablebody, $kolombody++, $data->telepon_kantor);
			xlsWriteLabel($tablebody, $kolombody++, $data->faksimili_kantor);
			xlsWriteLabel($tablebody, $kolombody++, $data->kantor_sebelumnya);
			xlsWriteLabel($tablebody, $kolombody++, $data->pendapatan_pertahun);
			xlsWriteLabel($tablebody, $kolombody++, $data->lokasi_rumah);
			xlsWriteLabel($tablebody, $kolombody++, $data->njob);
			xlsWriteLabel($tablebody, $kolombody++, $data->deposit_bank);
			xlsWriteLabel($tablebody, $kolombody++, $data->jumlah_kekayaan);
			xlsWriteLabel($tablebody, $kolombody++, $data->kekayaan_lainnya);
			xlsWriteLabel($tablebody, $kolombody++, $data->pict_identitas);
			xlsWriteLabel($tablebody, $kolombody++, $data->foto_terkini);
			xlsWriteLabel($tablebody, $kolombody++, $data->jenis_dokumen_tambahan);
			xlsWriteLabel($tablebody, $kolombody++, $data->dokumen_tambahan);
			xlsWriteLabel($tablebody, $kolombody++, $data->perusahaan_simulasi);
			xlsWriteLabel($tablebody, $kolombody++, $data->penyelesaian_perselisihan);
			xlsWriteLabel($tablebody, $kolombody++, $data->daftar_kantor);
			xlsWriteLabel($tablebody, $kolombody++, $data->status);
			xlsWriteLabel($tablebody, $kolombody++, $data->status_verify);
			xlsWriteLabel($tablebody, $kolombody++, $data->is_active);
			xlsWriteLabel($tablebody, $kolombody++, $data->komentar);
			xlsWriteNumber($tablebody, $kolombody++, $data->nasabah_role_id);
			xlsWriteLabel($tablebody, $kolombody++, $data->created_date);
			xlsWriteNumber($tablebody, $kolombody++, $data->user_id);
			xlsWriteLabel($tablebody, $kolombody++, $data->update_date);
			xlsWriteNumber($tablebody, $kolombody++, $data->update_user_id);

			$tablebody++;
			$nourut++;
		}

		xlsEOF();
		exit();
	}

	public function word()
	{
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=nasabah.doc");

		$data = array(
			'nasabah_data' => $this->Nasabah_model->get_all(),
			'start' => 0
		);

		$this->load->view('nasabah/nasabah_doc',$data);
	}

	public function printdoc(){
		$data = array(
			'nasabah_data' => $this->Nasabah_model->get_all(),
			'start' => 0
		);
		$this->load->view('nasabah/nasabah_print', $data);
	}

}
