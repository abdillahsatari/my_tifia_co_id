<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registercomplete extends CI_Controller
{

	var $uploaded;

	function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model(array('Nasabah_model' => 'm_nasabah', 'Bank_model' => 'm_bank', 'Acc_demo_model' => 'm_demo', 'Acc_request_model' => 'm_req'));
		cekLogin();
		$this->uploaded = array('identitas' => '', 'npwp' => '', 'tabungan' => '', 'foto' => '');
	}

	public function index()
	{
		$nasabah_id = $this->session->userdata('cd_id');

		// Cek apakag memiliki akun demo
		$cek = $this->db->query("SELECT * FROM acc_demo WHERE nasabah_id='$nasabah_id'")->num_rows();

		if ($cek > 0) {

			//panggil demo akun
			//--

			$noacc = $this->m_demo->getData($this->session->userdata('cd_id'));

			$rowData = $this->m_nasabah->get_by_id($this->session->userdata('cd_id'));

			$idr = $this->m_bank->get_last_where_IDR($this->session->userdata('cd_id'));

			$usd = $this->m_bank->get_last_where_USD($this->session->userdata('cd_id'));
			// echo $noacc[0]->no_akun;
			$data = array(
				'button' => 'Create',
				'action' => site_url('registercomplete/save'),

				'email' => $this->session->userdata('nsb_email'),
				'nama_lengkap' => $this->session->userdata('nsb_nama'),
				'tempat_lahir' => set_value('tempat_lahir', $rowData->tempat_lahir),
				'tgl_lahir' => set_value('tgl_lahir', $rowData->tgl_lahir),
				'alamat_rumah' => set_value('alamat_rumah', $rowData->alamat_rumah),
				'kode_pos' => set_value('kode_pos', $rowData->kode_pos),
				'no_identitas' => set_value('no_identitas', $rowData->no_identitas),
				'noakundemo' => $noacc[0]->no_akun,
				'pengalaman_investasi' => set_value('pengalaman_investasi', $rowData->pengalaman_investasi),
				'tujuan_pembukaan_rek' => set_value('tujuan_pembukaan_rek', $rowData->tujuan_pembukaan_rek),
				'no_npwp' => set_value('no_npwp', $rowData->no_npwp),
				'status_kawin' => set_value('status_kawin', $rowData->status_kawin),
				'nama_pasangan' => set_value('nama_pasangan', $rowData->nama_pasangan),
				'nama_ibu' => set_value('nama_ibu', $rowData->nama_ibu),
				'kewarganegaraan' => set_value('kewarganegaraan', $rowData->kewarganegaraan),
				'status_rumah' => set_value('status_rumah', $rowData->status_rumah),
				'gender' => set_value('gender', $rowData->gender),
				'no_tlp' => set_value('no_tlp', $rowData->no_tlp),
				'no_faksimili' => set_value('no_faksimili', $rowData->no_faksimili),
				'keluarga_bapepti' => set_value('keluarga_bapepti', $rowData->keluarga_bapepti),
				'status_pailit' => set_value('status_pailit', $rowData->status_pailit),

				'nama_rekan' => set_value('nama_rekan', $rowData->nama_rekan),
				'telepon_rekan' => set_value('telepon_rekan', $rowData->telepon_rekan),
				'hubungan_rekan' => set_value('hubungan_rekan', $rowData->hubungan_rekan),
				'alamat_rekan' => set_value('alamat_rekan', $rowData->alamat_rekan),
				'kode_pos_rekan' => set_value('kode_pos_rekan', $rowData->kode_pos_rekan),

				'pekerjaan' => set_value('pekerjaan', $rowData->pekerjaan),
				'nama_perusahaan' => set_value('nama_perusahaan', $rowData->nama_perusahaan),
				'bidang_usaha' => set_value('bidang_usaha', $rowData->bidang_usaha),
				'jabatan' => set_value('jabatan', $rowData->jabatan),
				'lama_kerja' => set_value('lama_kerja', $rowData->lama_kerja),
				'kantor_sebelumnya' => set_value('kantor_sebelumnya', $rowData->kantor_sebelumnya),
				'alamat_kantor' => set_value('alamat_kantor', $rowData->alamat_kantor),
				'kode_pos_kantor' => set_value('kode_pos_kantor', $rowData->kode_pos_kantor),
				'telepon_kantor' => set_value('telepon_kantor', $rowData->telepon_kantor),
				'faksimili_kantor' => set_value('faksimili_kantor', $rowData->faksimili_kantor),

				'pendapatan_pertahun' => set_value('pendapatan_pertahun', $rowData->pendapatan_pertahun),
				'lokasi_rumah' => set_value('lokasi_rumah', $rowData->lokasi_rumah),
				'njob' => set_value('njob', $rowData->njob),
				'deposit_bank' => set_value('deposit_bank', $rowData->deposit_bank),
				'jumlah_kekayaan' => set_value('jumlah_kekayaan', $rowData->jumlah_kekayaan),
				'kekayaan_lainnya' => set_value('kekayaan_lainnya', $rowData->kekayaan_lainnya),
				'wakil_pialang' => isset($rowData->wakil_pialang) ? set_value('wakil_pialang', $rowData->wakil_pialang) : null,
				'penyelesaian_perselisihan' => set_value('penyelesaian_perselisihan', $rowData->penyelesaian_perselisihan),

				'bank_id' => isset($idr->bank_id) ? $idr->bank_id : "",
				'nama_bank' => isset($idr->nama_bank) ? $idr->nama_bank : "",
				'no_rekening' => isset($idr->no_rekening) ? $idr->no_rekening : "",
				'cabang' => isset($idr->cabang) ? $idr->cabang : "",
				'jenis_rekening' => isset($idr->jenis_rekening) ? $idr->jenis_rekening : "",
				'telepon_bank' => isset($idr->telepon_bank) ? $idr->telepon_bank : "",
				'kode_bank' => isset($idr->kode_bank) ? $idr->kode_bank : "",
				'atas_nama' => isset($idr->atas_nama) ? $idr->atas_nama : "",

				'bank_id2' => isset($usd->bank_id) ? $usd->bank_id : "",
				'nama_bank2' => isset($usd->nama_bank) ? $usd->nama_bank : "",
				'no_rekening2' => isset($usd->no_rekening) ? $usd->no_rekening : "",
				'cabang2' => isset($usd->cabang) ? $usd->cabang : "",
				'jenis_rekening2' => isset($usd->jenis_rekening) ? $usd->jenis_rekening : "",
				'telepon_bank2' => isset($usd->telepon_bank) ? $usd->telepon_bank : "",
				'kode_bank2' => isset($usd->kode_bank) ? $usd->kode_bank : "",
				'atas_nama2' => isset($usd->atas_nama) ? $usd->atas_nama : "",

				'foto' => set_value('pict_identitas', $rowData->pict_identitas),
				'identitas' => set_value('foto_terkini', $rowData->foto_terkini),
				'npwp' => set_value('foto_npwp', $rowData->foto_npwp),
				'tabungan' => set_value('foto_buku_tabungan', $rowData->foto_buku_tabungan),
			);

			$this->load->view('templates/header');
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');

			$nsbh = $this->db->query('SELECT tipe, status FROM nasabah WHERE nasabah_id="' . $this->session->userdata('cd_id') . '"')->row_array();

			// cek apakah sudah isi agreement atau belum
			if ($nsbh['status'] == 'Register') {

				// cek tipe agreement
				if ($nsbh['tipe'] == 'SPA') {
					$this->load->view('kabinet/auth-registercomplete-spa', $data);
				} elseif ($nsbh['tipe'] == 'Multilateral') {
					$this->load->view('kabinet/auth-registercomplete-multi', $data);
				}
			} else {
				$this->load->view('kabinet/auth-registercomplete_selesai');
			}
			$this->load->view('templates/footer');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                                      Mohon untuk membuat akun demo terlebih dahulu!
                                                    </div>');
			redirect('kabinet');
		}
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
		$configured['allowed_types'] = 'png|jpg|jpeg';
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

		// if (isset($_FILES['npwp']) && !empty($_FILES['npwp']['name'])) {
		// 	if ($this->upload->do_upload('npwp')) {
		// 		$this->uploaded['npwp'] = $this->upload->data("file_name");
		// 	} else {
		// 		$this->uploaded['npwp'] = "default.jpg";
		// 	}
		// }
		// echo json_encode(array('identitas' => $this->uploaded['identitas'], 'npwp' => $this->uploaded['npwp'], 'tabungan' => $this->uploaded['tabungan'], 'foto' => $this->uploaded['foto']));
	}

	public function save()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => ''];

			// $this->_rules();
			// if ($this->form_validation->run() == TRUE) {
			$json['form_validation'] = TRUE;

			// upload foto
			$this->uploadfoto();

			// Start database transactions
			$this->db->trans_start();

			if ($this->session->userdata('nsb_status') == 'Register') {
				$status = 'Complete';
			} else {
				$status = $this->session->userdata('nsb_status');
			}

			$data = array(
				'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
				'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
				'tgl_lahir' => $this->input->post('tgl_lahir', TRUE),
				'alamat_rumah' => $this->input->post('alamat_rumah', TRUE),
				'kode_pos' => $this->input->post('kode_pos', TRUE),
				// Jenis Identitas harcoded KTP berhubung tidak ada pilihan di form
				'jenis_identitas' => "KTP",
				'no_identitas' => $this->input->post('no_identitas', TRUE),
				'pengalaman_investasi' => $this->input->post('pengalaman_investasi', TRUE),
				'tujuan_pembukaan_rek' => $this->input->post('tujuan_pembukaan_rek', TRUE),
				'no_npwp' => $this->input->post('no_npwp', TRUE),
				'gender' => $this->input->post('gender', TRUE),
				'status_kawin' => $this->input->post('status_kawin', TRUE),
				'nama_pasangan' => $this->input->post('nama_pasangan', TRUE),
				'nama_ibu' => $this->input->post('nama_ibu', TRUE),
				'kewarganegaraan' => $this->input->post('kewarganegaraan', TRUE),
				'status_rumah' => $this->input->post('status_rumah', TRUE),
				'no_tlp' => $this->input->post('no_tlp', TRUE),
				'no_hp' => $this->input->post('no_tlp', TRUE),
				'email' => $this->session->userdata('nsb_email'),
				'no_faksimili' => $this->input->post('no_faksimili', TRUE),
				// Password dikosongkan
				// 'password' => $this->session->userdata('nsb_password'),
				'keluarga_bapepti' => $this->input->post('keluarga_bapepti', TRUE),
				// 'alamat_surat_menyurat' => $this->input->post('alamat_rumah', TRUE),
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
				// 'foto_npwp' => $this->uploaded['npwp'],
				'wakil_pialang' => $this->input->post('wakilpialang', TRUE),
				'penyelesaian_perselisihan' => $this->input->post('penyelesaian_perselisihan', TRUE),
				'status' => $status,

				'update_date' => date('Y-m-d h:i:S'),
			);

			$dataBankIDR = array(
				'nasabah_id' => $this->session->userdata('cd_id'),
				'nama_bank' => $this->input->post('nama_bank', TRUE),
				'cabang' => $this->input->post('cabang', TRUE),
				// 'telepon_bank' => $this->input->post('telepon_bank', TRUE),
				'no_rekening' => $this->input->post('no_rekening', TRUE),
				// 'kode_bank' => $this->input->post('kode_bank', TRUE),
				'atas_nama' => $this->input->post('atas_nama', TRUE),
				'jenis_rekening' => $this->input->post('jenis_rekening', TRUE),
				'currency' => 'IDR',
				'created_date' => date('Y-m-d h:i:s'),
				'status_bank' => 'Pending'
			);

			// $dataBankUSD = array(
			// 	'nasabah_id' => $this->session->userdata('cd_id'),
			// 	'nama_bank' => $this->input->post('nama_bank2', TRUE) ?: ' ',
			// 	'cabang' => $this->input->post('cabang2', TRUE) ?: ' ',
			// 	'telepon_bank' => $this->input->post('telepon_bank2', TRUE) ?: ' ',
			// 	'no_rekening' => $this->input->post('no_rekening2', TRUE) ?: ' ',
			// 	'kode_bank' => $this->input->post('kode_bank2', TRUE) ?: ' ',
			// 	'atas_nama' => $this->input->post('atas_nama2', TRUE) ?: ' ',
			// 	'jenis_rekening' => $this->input->post('jenis_rekening2', TRUE) ?: ' ',
			// 	'currency' => 'USD',
			// 	'created_date' => date('Y-m-d h:i:s'),
			// 	'status_bank' => 'Pending'
			// );

			$lastRequest = $this->m_req->get_last_by_id_nasabah($this->session->userdata('cd_id'));

			$this->m_nasabah->update($this->session->userdata('cd_id'), $data);
			if ($this->input->post('bank_id') == NULL) {
				$this->m_bank->insert($dataBankIDR);
			} else {
				$this->m_bank->update($this->input->post('bank_id'), $dataBankIDR);
			}

			// // $this->m_req->update($lastRequest->acc_request_id, $dataWP);
			// if ($this->input->post('bank_id2') == NULL) {
			// 	if ($dataBankUSD['nama_bank'] != ' ' && $dataBankUSD['cabang'] != ' ' && $dataBankUSD['telepon_bank'] != ' ' && $dataBankUSD['no_rekening'] != ' ' && $dataBankUSD['kode_bank'] != ' ' && $dataBankUSD['atas_nama'] != ' ' && $dataBankUSD['jenis_rekening'] != ' ') {
			// 		$this->m_bank->insert($dataBankUSD);
			// 	}
			// } else {
			// 	$this->m_bank->update($this->input->post('bank_id2'), $dataBankUSD);
			// }

			$data = array('nsb_photo' => $data['foto_terkini'], 'nsb_nama' => $data['nama_lengkap'], 'nsb_status' => $data['status']);


			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$json['alert'] = 'Agreement tidak terkirim';
			} else {

				//menyimpan session
				$this->session->set_userdata($data);

				// send whatsapp
				$this->Rapiwha->send_fromAdmin('Notifikasi: Nasabah dengan akun ' . $this->session->userdata('nsb_email') . ' telah menyelesaikan Agreement. Mohon untuk segera melakukan approval.', 6);

				// send email
				$this->_sendEmail();

				$json['success'] = TRUE;
				$json['alert'] = 'Agreement akan diperiksa oleh tim kami';
			}
			// } else {
			// 	foreach ($_POST as $key => $value) {
			// 		// $json['alert'][$key] = form_error($key);
			// 		$alrt = '<ul>';
			// 		if (form_error($key) != '') {
			// 			$json['alert'] .= '<li>' . form_error($key) . '</li>';
			// 		}
			// 		$alrt .= '</ul>';
			// 	}
			// }
			echo json_encode($json);
		}
	}

	private function _save() // asli
	{
		$this->db->trans_start();

		$this->uploadfoto();

		if ($this->session->userdata('nsb_status') == 'Register') {
			$status = 'Complete';
		} else {
			$status = $this->session->userdata('nsb_status');
		}

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
			'wakil_pialang' => $this->input->post('wakilpialang', TRUE),
			'penyelesaian_perselisihan' => $this->input->post('penyelesaian_perselisihan', TRUE),
			'status' => $status,

			'update_date' => date('Y-m-d h:i:S'),
		);

		$dataBankIDR = array(
			'nasabah_id' => $this->session->userdata('cd_id'),
			'nama_bank' => $this->input->post('nama_bank', TRUE),
			'cabang' => $this->input->post('cabang', TRUE),
			// 'telepon_bank' => $this->input->post('telepon_bank', TRUE),
			'no_rekening' => $this->input->post('no_rekening', TRUE),
			// 'kode_bank' => $this->input->post('kode_bank', TRUE),
			'atas_nama' => $this->input->post('atas_nama', TRUE),
			'jenis_rekening' => $this->input->post('jenis_rekening', TRUE),
			'currency' => 'IDR',
			'created_date' => date('Y-m-d h:i:s'),
			'status_bank' => 'Pending'
		);

		// $dataBankUSD = array(
		// 	'nasabah_id' => $this->session->userdata('cd_id'),
		// 	'nama_bank' => $this->input->post('nama_bank2', TRUE) ?: ' ',
		// 	'cabang' => $this->input->post('cabang2', TRUE) ?: ' ',
		// 	'telepon_bank' => $this->input->post('telepon_bank2', TRUE) ?: ' ',
		// 	'no_rekening' => $this->input->post('no_rekening2', TRUE) ?: ' ',
		// 	'kode_bank' => $this->input->post('kode_bank2', TRUE) ?: ' ',
		// 	'atas_nama' => $this->input->post('atas_nama2', TRUE) ?: ' ',
		// 	'jenis_rekening' => $this->input->post('jenis_rekening2', TRUE) ?: ' ',
		// 	'currency' => 'USD',
		// 	'created_date' => date('Y-m-d h:i:s'),
		// 	'status_bank' => 'Pending'
		// );

		$lastRequest = $this->m_req->get_last_by_id_nasabah($this->session->userdata('cd_id'));

		$this->m_nasabah->update($this->session->userdata('cd_id'), $data);
		if ($this->input->post('bank_id') == NULL) {
			$this->m_bank->insert($dataBankIDR);
		} else {
			$this->m_bank->update($this->input->post('bank_id'), $dataBankIDR);
		}

		// // $this->m_req->update($lastRequest->acc_request_id, $dataWP);
		// if ($this->input->post('bank_id2') == NULL) {
		// 	if ($dataBankUSD['nama_bank'] != ' ' && $dataBankUSD['cabang'] != ' ' && $dataBankUSD['telepon_bank'] != ' ' && $dataBankUSD['no_rekening'] != ' ' && $dataBankUSD['kode_bank'] != ' ' && $dataBankUSD['atas_nama'] != ' ' && $dataBankUSD['jenis_rekening'] != ' ') {
		// 		$this->m_bank->insert($dataBankUSD);
		// 	}
		// } else {
		// 	$this->m_bank->update($this->input->post('bank_id2'), $dataBankUSD);
		// }

		$data = array('nsb_photo' => $data['foto_terkini'], 'nsb_nama' => $data['nama_lengkap'], 'nsb_status' => $data['status']);


		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$dataas = array('success' => false, 'message' => 'Registrasi gagal');
			echo json_encode($dataas);
		} else {

			//menyimpan session
			$this->session->set_userdata($data);

			$this->_sendEmail();

			$dataas = array('success' => true, 'message' => 'Registrasi berhasil');
			echo json_encode($dataas);
		}
	}

	private function _sendEmail()
	{
		// Load helper email dan konfigurasinya
		$this->load->helper('send_email_helper');
		$email['email'] = 'settlement@tifia.co.id';
		$email['subjek'] = 'Register Complete';
		$email['pesan'] = 'Dear admin, seorang nasabah dengan akun ' . $this->session->userdata('nsb_email') . ' telah melakukan register complete. Mohon untuk segera melakukan approval.';
		$msg = send_mailer($email);

		// Tampilkan pesan sukses atau error
		if ($msg['is_sent'] == TRUE) {
			return true;
		} else {
			echo $msg['error'];
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

	private function _rules()
	{
		$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required|alpha');
		$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required|alpha');
		$this->form_validation->set_rules('tgl_lahir', 'tanggal lahir', 'trim|required|xss_clean');
		$this->form_validation->set_rules('alamat_rumah', 'alamat rumah', 'trim|required');
		$this->form_validation->set_rules('kode_pos', 'kode pos', 'trim|required|numeric|min_length[5]|max_length[6]');
		$this->form_validation->set_rules('no_identitas', 'no identitas', 'trim|required|exact_length[16]');
		$this->form_validation->set_rules('pengalaman_investasi', 'pengalaman investasi', 'trim|required');
		$this->form_validation->set_rules('tujuan_pembukaan_rek', 'tujuan pembukaan rek', 'trim|required');
		$this->form_validation->set_rules('no_npwp', 'no npwp', 'trim|required|numeric|exact_length[16]');
		$this->form_validation->set_rules('gender', 'gender', 'trim|required');
		$this->form_validation->set_rules('status_kawin', 'status kawin', 'trim|required');
		$this->form_validation->set_rules('nama_pasangan', 'status kawin', 'trim|alpha');
		$this->form_validation->set_rules('nama_ibu', 'nama ibu', 'trim|required|alpha');
		$this->form_validation->set_rules('kewarganegaraan', 'kewarganegaraan', 'trim|required|alpha');
		$this->form_validation->set_rules('status_rumah', 'status rumah', 'trim|required');
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
		$this->form_validation->set_rules('kantor_sebelumnya', 'kantor sebelumnya', 'trim|required');
		$this->form_validation->set_rules('alamat_kantor', 'alamat kantor', 'trim|required');
		$this->form_validation->set_rules('kode_pos_kantor', 'kode pos kantor', 'trim|required|min_length[5]|max_length[6]');
		$this->form_validation->set_rules('telepon_kantor', 'telepon kantor', 'trim|required|min_length[11]|max_length[13]');
		$this->form_validation->set_rules('faksimili_kantor', 'faksimili kantor', 'trim|required|min_length[11]|max_length[13]');

		$this->form_validation->set_rules('pendapatan_pertahun', 'pendapatan pertahun', 'trim|required');
		$this->form_validation->set_rules('lokasi_rumah', 'lokasi rumah', 'trim|required');
		$this->form_validation->set_rules('njob', 'njob', 'trim|required');
		$this->form_validation->set_rules('deposit_bank', 'deposit bank', 'trim|required');
		$this->form_validation->set_rules('jumlah_kekayaan', 'jumlah kekayaan', 'trim|required');
		$this->form_validation->set_rules('kekayaan_lainnya', 'kekayaan lainnya', 'trim');

		$this->form_validation->set_rules('nama_bank', 'nama_bank', 'trim|required');
		$this->form_validation->set_rules('cabang', 'cabang', 'trim|required');
		// $this->form_validation->set_rules('telepon_bank', 'telepon_bank', 'trim|required|min_length[11]|max_length[13]');
		$this->form_validation->set_rules('no_rekening', 'no_rekening', 'trim|required|numeric');
		// $this->form_validation->set_rules('kode_bank', 'kode_bank', 'trim|required');
		$this->form_validation->set_rules('atas_nama', 'atas_nama', 'trim|required|alpha');
		$this->form_validation->set_rules('jenis_rekening', 'jenis_rekening', 'trim|required');

		// $this->form_validation->set_rules('nama_bank2', 'nama_bank usd', 'trim|required');
		// $this->form_validation->set_rules('cabang2', 'cabang usd', 'trim|required');
		// $this->form_validation->set_rules('telepon_bank2', 'telepon_bank usd', 'trim|required|min_length[11]|max_length[13]');
		// $this->form_validation->set_rules('no_rekening2', 'no_rekening usd', 'trim|required|numeric');
		// $this->form_validation->set_rules('kode_bank2', 'kode_bank usd', 'trim|required');
		// $this->form_validation->set_rules('atas_nama2', 'atas_nama usd', 'trim|required|alpha');
		// $this->form_validation->set_rules('jenis_rekening2', 'jenis_rekening usd', 'trim|required');

		// $this->form_validation->set_rules('identitas', 'foto identitas', 'callback_validate_identitas');
		// $this->form_validation->set_rules('photo', 'foto selfie terbaru', 'callback_validate_foto');
		// $this->form_validation->set_rules('tabungan', 'foto cover buku tabungan', 'required');
		// $this->form_validation->set_rules('image3', 'npwp', 'callback_validate_npwp');

		// $this->form_validation->set_rules('nasabah_id', 'nasabah_id', 'trim');
		// $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
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
