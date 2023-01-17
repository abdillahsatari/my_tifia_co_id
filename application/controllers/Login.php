<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Login
 */
class Login extends CI_Controller
{
	/**
	 * Login constructor.
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->model(array('Nasabah_model', 'Log_model', 'Ion_auth_model'));
	}

	public function index()
	{
		if (!empty($this->session->userdata('nsb_email'))) {
			if ($this->session->userdata('nsb_role_id') == 1) {
				redirect('admin');
			} else {
				redirect('kabinet');
			}
		}

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('auth-nasabah');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email', TRUE);
		$password = $this->input->post('password', TRUE);

		$user = $this->Nasabah_model->getdata('email', $email)->row_array();

		if ($user) {
			// jika user sudah verifikasi email 'Y'
			if ($user['status_verify'] == 'Y') {
				if ($user['is_active'] == '1') {
					# jika password nya benar
					if (password_verify($password, $user['password'])) {
						# code...
						$data = array(
							'cd_id' 		=> $user['nasabah_id'],
							'nsb_email' 	=> $user['email'],
							'nsb_password' 	=> $this->Ion_auth_model->hash_password($password, PASSWORD_DEFAULT),
							'nsb_role_id' 	=> $user['nasabah_role_id'],
							'nsb_photo' 	=> $user['foto_terkini'],
							'nsb_nama'	 	=> $user['nama_lengkap'],
							'nsb_status' 	=> $user['status'],
							// 'theme' 		=> $user['theme']
						);

						// todo: add to session
						$this->session->set_userdata($data);

						//menyimpan log
						$dataLog = array(
							'nasabah_id' => $user['nasabah_id'],
							'type' => 'login',
							'read_status' => 'NULL',
							'aktifitas' => 'Login'
						);
						$this->Log_model->insert($dataLog);

						// menyimpan di cookie setcookie('emailku', $user['email']);
						if (isset($_POST['remember'])) {
							// membuat cookie
							setcookie('emailku', 'cobaaja',  time() + 60);
						}
						// cek role_id user
						if ($data['nsb_role_id'] == 1) {
							redirect('admin');
						} elseif ($data['nsb_role_id'] == 2) {
							redirect('kabinet');
						}
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email atau password salah!</div>');
						redirect('login');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun sudah tidak aktif!</div>');
					redirect('login', 'refresh');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email anda belum di verifikasi, silahkan cek email anda!</div>');
				redirect('login', 'refresh');
			}
		} else {
			// tidak ada user
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
			redirect('login', 'refresh');
		}
	}

	// registrasi
	public function registration()
	{
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules(
			'email',
			'Email',
			'trim|required|valid_email|is_unique[nasabah.email]',
			array('is_unique' => 'Email sudah terdaftar!')
		);

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[password2]', array(
			'matches'      => 'Password tidak sama!',
			'min_length'     => 'Password terlalu pendek!.'
		));

		$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('tipe', 'Tipe', 'required|in_list[Multilateral,SPA]');
		$this->form_validation->set_rules('referral', 'kode referral', 'trim|xss_clean|callback__referral_check');

		$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

		if ($this->form_validation->run() == false) {
			$this->load->view('auth-register');
		} else {

			$date = date('Y-m-d H:i:s');

			$this->db->trans_begin();

			// cek apakah ada referral
			if ($this->input->post('referral', true)) {
				$kode = $this->input->post('referral', true);

				$qry_mkt = $this->db->query("SELECT id FROM marketing WHERE kode='$kode'");
				if ($qry_mkt->num_rows() > 0) {
					$res = $qry_mkt->row_array();
					$referral_marketing_id = $res['id'];
				} else {
					$qry_mkt = $this->db->query('SELECT MIN(id) as a FROM marketing')->row_array();
					$referral_marketing_id = $qry_mkt['a'];
				}
			} else {
				$qry_mkt = $this->db->query('SELECT MIN(id) as a FROM marketing')->row_array();
				$referral_marketing_id = $qry_mkt['a'];
			}

			// Buat Akun
			$nama_lengkap = $this->input->post('nama_lengkap', true);
			$email = $this->input->post('email', true);
			$data = array(
				'parent_id' => $referral_marketing_id,
				'nama_lengkap' => htmlspecialchars($nama_lengkap),
				'email'        => htmlspecialchars($email),
				'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'tipe'    => $this->input->post('tipe'),
				'status'	=> 'Register',
				'status_verify'    => 'T',
				'is_active' => 1,
				'nasabah_role_id'    => 2,
				'foto_terkini'    => "default.jpg",
				'created_date' => $date
			);
			// siapakan token untuk dikirim ke email
			$token = random_string('alnum', 64);
			$user_token = ['email' => $email, 'token' => $token, 'created_date' => time()];

			// insert ke tabel users
			$this->db->insert('nasabah', $data);
			$nasabah_id =  $this->db->insert_id();

			// insert ke tabel user_token
			$this->db->insert('nasabah_token', $user_token);

			// Buat akun Demo MetaTrader
			// API

			$metaTrader['user'] = rand('0', '999999');
			$metaTrader['pass_trade'] = rand('0', '999999');
			$metaTrader['pass_investor'] = rand('0', '999999');
			$metaTrader['server'] = '';
			$metaTrader['port'] = '';

			// // Request
			// $acc_request = array(
			// 	'nasabah_id' => $nasabah_id,
			// 	'acc_currency_id' => 2,
			// 	'acc_type_id' => 1,
			// 	'acc_leverage_id' => 1,
			// 	'date' => $date,
			// 	'status_request' => 'Aktif'
			// );
			// $this->db->insert('acc_request', $acc_request);
			// $acc_request_id =  $this->db->insert_id();

			// // Demo
			// //0. mendapatkan data request akun berdasarkan id request akun
			// $acc_demo = array(
			// 	'no_akun' => $metaTrader['user'],
			// 	'acc_request_id' => $acc_request_id,
			// 	'acc_currency_id' => 2,
			// 	'acc_leverage_id' => 1,
			// 	'nasabah_id' => $nasabah_id,
			// 	'acc_type_id' => 1,
			// 	'password_trade' => $metaTrader['pass_trade'],
			// 	'password_investor' => $metaTrader['pass_investor'],
			// 	'ip' => $metaTrader['server'],
			// 	'port' => $metaTrader['port'],
			// 	'tanggal_buat_akun' => $date,
			// 	'status_aktif' => 'Aktif',
			// 	'user_id' => NULL
			// );
			// $this->db->insert('acc_demo', $acc_demo);

			// //4. masukkan aktifitas ke users_log
			// $dataLog = array(
			// 	'user_id' => NULL,
			// 	'nasabah_id' => $nasabah_id,
			// 	'acc_request_id' => $acc_request_id,
			// 	'no_akun_demo' => $metaTrader['user'],
			// 	'type' => 'Create Akun Trading Demo',
			// 	'read_status' => 'Y',
			// 	'aktifitas' => 'Membuat Akun Trading Demo'
			// );
			// $this->Log_model->insert_admin($dataLog);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				flash_alert('Register failed', 'danger');
				redirect(site_url('adminarea/acc_demo'));
			} else {
				// send Email
				$sendEmail = $this->_sendEmail($token, 'Verifikasi Email', $metaTrader);
				$sendEmailAdmin = $this->_sendEmailAdmin();

				// if ($sendEmail == true && $sendEmailAdmin == true) {

				$this->db->trans_commit();
				flash_alert('Pendaftaran Berhasil! Silahkan cek email Anda dan segera melakukan verifikasi 1x24jam.', 'success');
				// } else {
				// 	$this->db->trans_rollback();
				// 	flash_alert('Pendaftaran gagal. Email tidak terkirim.', 'danger');
				// }

				redirect('login', 'refresh');
			}
		}
	}

	private function get_by_nasabah_id($id)
	{
		$this->db->select('*');
		$this->db->from('acc_request');
		$this->db->join('nasabah', 'acc_request.nasabah_id = nasabah.nasabah_id');
		$this->db->join('acc_type', 'acc_request.acc_type_id = acc_type.acc_type_id');
		$this->db->join('acc_currency', 'acc_request.acc_currency_id = acc_currency.acc_currency_id', 'left');
		$this->db->join('acc_leverage', 'acc_request.acc_leverage_id = acc_leverage.acc_leverage_id', 'left');
		$this->db->where('', $id);
		return $this->db->get()->row();
	}

	public function lupa_password()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() ==  FALSE) {
			$this->load->view('auth-lupapassword', FALSE);
		} else {
			$email = $this->input->get_post('email');
			$user = $this->Nasabah_model->getdata('email', $email)->row_array();

			if ($user) {

				$this->db->trans_begin();


				$newpass = random_string('alnum', 8);

				$data = array(
					'password'     => password_hash($newpass, PASSWORD_DEFAULT),
					'update_date' => date('Y-m-d H:i:s')
				);

				$this->Nasabah_model->update($user['nasabah_id'], $data);

				//menyimpan log
				$dataLog = array(
					'nasabah_id' => $user['nasabah_id'],
					'type' => 'Change Password',
					'read_status' => 'NULL',
					'aktifitas' => 'Lupa Password'
				);
				$this->Log_model->insert($dataLog);

				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					flash_alert('Register failed', 'danger');
					redirect(site_url('adminarea/acc_demo'));
				} else {

					$sendEmail = $this->_sendEmail($newpass, 'Lupa Password', ['nama' => $user['nama_lengkap'], 'email' => $email, 'password' => $newpass]);
					if ($sendEmail == true) {

						$this->db->trans_commit();
						$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Password baru telah berhasil dikirim ke email anda</div>');
					} else {
						$this->db->trans_rollback();
						flash_alert('Kirim email gagal.', 'danger');
					}
					redirect('lupa_password');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
				redirect('lupa_password');
			}
		}
	}

	/**
	 * @param $data
	 * @param $type
	 * @return bool
	 */
	private function _sendEmail($token, $type, $metaTrader)
	{
		// Email penerima
		$pass = $this->input->post('password');
		$email = $this->input->post('email', TRUE);
		$nama_lengkap = $this->input->post('nama_lengkap', true);

		// Isi email
		if ($type == 'Verifikasi Email') {
			// tanpa menggunakan template_email
			#$this->email->message('Click this link to verify you account : <a href="' . base_url() . 'verify?email=' . $this->input->post('email', TRUE) . '&token=' . urlencode($data) . '">Activate</a>');

			// menggunakan template_email/email_aktivasi
			$data_email['pesan'] = $this->getEmailBody($nama_lengkap, $email, $token, $type, $pass, $metaTrader);
		} elseif ($type = 'Lupa Password') {
			$data_email['pesan'] = $this->load->view('template_email/email_reset_password', ['user' => $metaTrader], true);
		}

		// Load helper email dan konfigurasinya
		$this->load->helper('send_email_helper');
		$data_email['email'] = $email;
		$data_email['subjek'] = $type;
		$msg = send_mailer($data_email);

		// Tampilkan pesan sukses atau error
		if ($msg['is_sent'] == TRUE) {
			return true;
		} else {
			// echo $msg['error'];
			// die();
			return false;
		}
	}

	private function _sendEmailAdmin()
	{
		// Load helper email dan konfigurasinya
		$this->load->helper('send_email_helper');
		$email['email'] = 'settlement@tifia.co.id';
		$email['subjek'] = 'Nasabah Baru';
		$email['pesan'] = 'Nasabah dengan email ' . $this->input->post('email', true) . ' telah mendaftar di kabinet RTF.';
		$msg = send_mailer($email);

		// Tampilkan pesan sukses atau error
		if ($msg['is_sent'] == TRUE) {
			return true;
		} else {
			// echo $msg['error'];
			// die();
			return false;
		}
	}

	public function verify()
	{
		# ambil email
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->Nasabah_model->getdata('email', $email)->row_array();

		if ($user) {
			# jika email dan token benar
			$user_token = $this->Nasabah_model->gettoken($email, $token)->row_array();
			if ($user_token) {
				if (time() - $user_token['created_date'] < (60 * 60 * 24)) {
					#update is_active
					$dataUpdateToken = array('status_verify' => 'Y');
					$this->Nasabah_model->update($user['nasabah_id'], $dataUpdateToken);

					$this->Nasabah_model->deletetoken($email);

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat, akun telah berhasil di verifikasi!</div>');
					redirect('login', 'refresh');
				} else { // jika expired

					# hapus token lama
					$this->Nasabah_model->deletetoken($email);

					# buatkan token baru
					$token = random_string('alnum', 64);
					$user_token = ['email' => $email, 'token' => $token, 'created_date' => time()];
					$this->db->insert('nasabah_token', $user_token);

					# kirim email
					$dataa['user'] = [
						'nama' => $user['nama_lengkap'],
						'email' => $email,
						'token' => $token
					];
					$data_email['pesan'] = $this->load->view('template_email/email_aktivasi_ulang', $dataa, true);
					$data_email['email'] = $email;
					$data_email['subjek'] = 'Verifikasi Email';

					// Load helper email dan konfigurasinya
					$this->load->helper('send_email_helper');
					send_mailer($data_email);

					$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Token kadaluarsa, email verifikasi baru telah terkirim. Mohon verifikasi kembali email Anda dalam 1x24 jam.</div>');
					redirect('login', 'refresh');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token salah!</div>');
				redirect('login', 'refresh');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal aktifitasi, email salah!</div>');
			redirect('login', 'refresh');
		}
	}

	/**
	 * @param $nama_lengkap
	 * @param $email
	 * @param $token
	 * @param $type
	 * @return mixed
	 */
	public function getEmailBody($nama_lengkap, $email, $token, $type, $pass, $metatrader)
	{
		$data['mt'] = $metatrader;
		$data['user'] = array('nama' => $nama_lengkap, 'email' => $email, 'token' => $token, 'type' => $type, 'password' => $pass);
		$msg = $this->load->view('template_email/email_aktivasi', $data, true);

		return $msg;
	}


	public function test()
	{

		$metaTrader['user_mt'] = '';
		$metaTrader['password_mt'] = '';
		$metaTrader['server_mt'] = '';

		echo $this->getEmailBody('andi fasata', 'email@saya.com', 'casascas', 'sacas', 'passsc12345', $metaTrader);
	}

	public function logout()
	{
		//menyimpan log
		$dataLog = array(
			'nasabah_id' => $this->session->userdata('cd_id'),
			'type' => 'logout',
			'read_status' => 'NULL',
			'aktifitas' => 'Logout'
		);
		$this->Log_model->insert($dataLog);

		$this->session->unset_userdata('cd_id');
		$this->session->unset_userdata('nsb_email');
		$this->session->unset_userdata('nsb_role_id');
		$this->session->unset_userdata('nsb_photo');
		$this->session->unset_userdata('nsb_nama');

		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Berhasil Logout</div>');

		redirect('login', 'refresh');
	}

	function _referral_check($value)
	{
		$query1 = $this->db->query(' SELECT id
                                    FROM marketing
                                    WHERE kode = "' . $value . '"');
		if ($query1->num_rows() > 0 || $value == '') {
			return TRUE;
		} else {
			$this->form_validation->set_message('_referral_check', '{field} tidak ditemukan.');
			return FALSE;
		}
	}

	public function test_email()
	{
		$this->load->helper('send_email');
		$data['email'] = "fasayayaqhsya@gmail.com";
		$data['subjek'] = "Test email";
		$data['pesan'] = "test";
		$msg = send_mailer($data);
		echo $msg['error'];
	}
}
