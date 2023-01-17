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

		$this->load->model(array('Log_model', 'Ion_auth_model'));
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {

			$this->session->unset_userdata('mkt');
			$this->session->unset_userdata('mkt_email');
			$this->session->unset_userdata('mkt_nama');
			$this->session->unset_userdata('mkt_password');
			$this->session->unset_userdata('mkt_kode');
			$this->session->unset_userdata('mkt_last_login');

			$this->load->view('auth-login');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email', TRUE);
		$password = $this->input->post('password', TRUE);

		$user = $this->db->query("SELECT * FROM marketing WHERE email='$email'")->row_array();

		if ($user) {
			// jika user sudah verifikasi email 'Y'
			if ($user['status_verify'] == 'Y') {
				if ($user['status_login'] == '1') {
					# jika password nya benar
					if (password_verify($password, $user['password'])) {

						$date = new_date();

						//set session
						$data = array(
							'mkt'				=> $user['id'],
							'mkt_email'			=> $user['email'],
							'mkt_nama'			=> $user['nama'],
							'mkt_password'		=> $this->Ion_auth_model->hash_password($password, PASSWORD_DEFAULT),
							'mkt_kode' 			=> $user['kode'],
							'mkt_last_login' 	=> strtotime($date)
						);
						$this->session->set_userdata($data);

						//menyimpan login history
						$marketing_login_history = [
							'marketing_id' => $user['id'],
							'ip_address' => $this->getRealIP(),
							'user_agent' => $_SERVER['HTTP_USER_AGENT'],
							'date' => $date
						];
						$this->db->insert('marketing_login_history', $marketing_login_history);
						$id_marketing_login_history = $this->db->insert_id();

						// insert log
						$marketing_log = [
							'marketing_id' => $user['id'],
							'summary' => "marketing_login_history[$id_marketing_login_history]",
							'tipe' => 'login',
							'aktifitas' => 'Login',
							'date' => $date
						];
						$this->db->insert('marketing_log', $marketing_log);


						// menyimpan di cookie setcookie('emailku', $user['email']);
						// if (isset($_POST['remember'])) {
						// 	// membuat cookie
						// 	setcookie('emailku', 'cobaaja',  time() + 60);
						// }

						// redirect ke dashboard
						redirect('dashboard');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email atau password salah!</div>');
						redirect('login');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun tidak aktif!</div>');
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

	public function lupa_password()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() ==  FALSE) {
			$this->load->view('auth-lupapassword', FALSE);
		} else {
			$email = $this->input->get_post('email');
			$user = $this->db->query("SELECT id, nama, email FROM marketing WHERE email='$email'")->row_array();

			if ($user) {
				$newpass = random_string('alnum', 8);

				$data = array(
					'password'     => password_hash($newpass, PASSWORD_DEFAULT),
					'date_updated' => new_date()
				);
				$this->db->update('marketing', $data, ['id' => $user['id']]);

				// insert log
				$marketing_log = [
					'marketing_id' => $user['id'],
					'summary' => "",
					'tipe' => 'reset password',
					'aktifitas' => 'Reset password',
					'date' => new_date()
				];
				$this->db->insert('marketing_log', $marketing_log);

				# kirim email
				// prepare Email
				$isi_email = [
					'nama' => $user['nama'],
					'email' => $user['email'],
					'password' => $newpass,
				];

				// Load helper email dan konfigurasinya
				$this->load->helper('send_email_helper');
				$data_email['email'] = $user['email'];
				$data_email['pesan'] = $this->getEmailBody($isi_email);
				$data_email['subjek'] = 'Reset password';
				$mail = send_mailer($data_email);
				if ($mail['is_sent']) {
					$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Password baru telah berhasil dikirim ke email Anda.</div>');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal. Mohon coba kembali atau hubungi CS kami.</div>');
				}
				redirect('lupa_password');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
				redirect('lupa_password');
			}
		}
	}

	private function getEmailBody($data)
	{
		$msg = $this->load->view('template_email/email_forgotpassword', ['user' => $data], true);

		return $msg;
	}


	private function getRealIP()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) //CHEK IP YANG DISHARE DARI INTERNET  
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //UNTUK CEK IP DARI PROXY  
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}


	public function logout()
	{
		// insert log
		$marketing_log = [
			'marketing_id' => sess('mkt'),
			'summary' => "",
			'tipe' => 'logout',
			'aktifitas' => 'Logout',
			'date' => new_date()
		];
		$this->db->insert('marketing_log', $marketing_log);

		$this->session->unset_userdata('mkt');
		$this->session->unset_userdata('mkt_email');
		$this->session->unset_userdata('mkt_nama');
		$this->session->unset_userdata('mkt_password');
		$this->session->unset_userdata('mkt_kode');
		$this->session->unset_userdata('mkt_last_login');

		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Berhasil Logout</div>');

		redirect('login', 'refresh');
	}
}
