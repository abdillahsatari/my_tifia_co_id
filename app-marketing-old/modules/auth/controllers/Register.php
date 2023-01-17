<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Login
 */
class Register extends CI_Controller
{
	/**
	 * Login constructor.
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->model(array('Log_model', 'Ion_auth_model'));
	}

	private function index()
	{
		$this->load->view('auth-register');
	}


	// registrasi
	private function registration()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required|xss_clean');
			$this->form_validation->set_rules(
				'email',
				'Email',
				'trim|required|valid_email|is_unique[marketing.email]',
				array('is_unique' => 'Email sudah terdaftar!')
			);
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[password2]', array(
				'matches'      => 'Password tidak sama!',
				'min_length'     => 'Password terlalu pendek!.'
			));
			$this->form_validation->set_rules('password2', 'Password', 'trim|required|matches[password]');
			$this->form_validation->set_rules('referral', 'referral', 'trim|xss_clean|callback__referral_check');

			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {

				$json['form_validation'] = TRUE;
				$date = date('Y-m-d H:i:s');

				// cek apakah ada referral
				if ($this->input->post('referral', true)) {
					$kode = $this->input->post('referral', true);

					$qry_mkt = $this->db->query("SELECT id FROM marketing WHERE kode='$kode'");
					if ($qry_mkt->num_rows() > 0) {
						$res = $qry_mkt->row_array();
						$referral_marketing_id = $res['id'];
						$pesan_log = "Register dengan referral [$kode]";
					} else {
						$qry_mkt = $this->db->query('SELECT MIN(id) as a FROM marketing')->row_array();
						$referral_marketing_id = $qry_mkt['a'];
						$pesan_log = "Register. Referral [$kode] tidak ditemukan";
					}
				} else {
					$qry_mkt = $this->db->query('SELECT MIN(id) as a FROM marketing')->row_array();
					$referral_marketing_id = $qry_mkt['a'];

					$pesan_log = "Register";
				}

				// Start database transaction
				$this->db->trans_start();

				// insert calon nasabah
				$marketing = [
					'parent_id' => $referral_marketing_id,
					'kode' => '0',
					'nama' => $this->input->post('nama_lengkap'),
					'email' => $this->input->post('email'),
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
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
					'marketing_id' => $id_marketing_baru,
					'summary' => "marketing[$id_marketing_baru]",
					'tipe' => 'register',
					'aktifitas' => $pesan_log,
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				$this->db->trans_complete();

				if ($this->db->trans_status()) {
					// prepare Email
					$isi_email = [
						'nama' => $this->input->post('nama_lengkap'),
						'email' => $this->input->post('email'),
						'password' =>  $this->input->post('password'),
						'token' => $token,
					];

					// Load helper email dan konfigurasinya
					$this->load->helper('send_email_helper');
					$data_email['email'] = $this->input->post('email');
					$data_email['pesan'] = $this->getEmailBody($isi_email);
					$data_email['subjek'] = 'Tahap terakhir untuk bergabung menjadi Mitra';
					send_mailer($data_email);

					$json['success'] = TRUE;
					$json['alert'] = 'Pendaftaran Berhasil! Silahkan cek email Anda dan segera melakukan verifikasi 1x24jam.';
					$json['href'] = base_url() . 'login';
				} else {
					$alert['alert'] = 'Pendaftaran Gagal';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	private function _sendEmailAdmin()
	{
		// Load helper email dan konfigurasinya
		$this->load->helper('send_email_helper');
		$email['email'] = 'Manager@tfx.co.id';
		$email['subjek'] = 'Nasabah Baru';
		$email['pesan'] = 'Nasabah dengan email ' . $this->input->post('email', true) . ' telah mendaftar di kabinet RTF.';
		$msg = send_mailer($email);

		// Tampilkan pesan sukses atau error
		if ($msg['is_sent'] == TRUE) {
			return true;
		} else {
			echo $msg['error'];
			die();
		}
	}

	public function verify()
	{
		# ambil email
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->query("SELECT id FROM marketing WHERE email='$email'")->row_array();

		if ($user) {
			# jika email benar
			$user_token = $this->db->query("SELECT * FROM marketing_token WHERE email='$email'")->row_array();
			if ($user_token) {
				if (time() - $user_token['created_date'] < (60 * 60 * 24)) {
					#update is_active
					$this->db->update('marketing', ['status_verify' => 'Y', 'status_login' => '1'], ['email' => $email]);

					$this->db->delete('marketing_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat, akun telah berhasil di verifikasi!</div>');
					redirect('login', 'refresh');
				} else {
					#hapus data di user_token
					$this->db->delete('marketing_token', ['email' => $email]);

					# hapus user akun jika expired
					$this->db->delete('marketing', ['id' => $user['id']]);

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token kadaluarsa, silahkan melakukan registrasi ulang.</div>');
					redirect('login', 'refresh');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error!</div>');
				redirect('login', 'refresh');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun tidak ditemukan. Mohon registrasi terlebih dahulu.</div>');
			redirect('login', 'refresh');
		}
	}

	private function getEmailBody($data)
	{
		$msg = $this->load->view('template_email/email_aktivasi', ['user' => $data], true);

		return $msg;
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
}
