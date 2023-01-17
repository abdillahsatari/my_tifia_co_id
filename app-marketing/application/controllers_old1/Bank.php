<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Bank
 */
class Bank extends CI_Controller
{
	/**
	 * Bank constructor.
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->model(array('Bank_model', 'Log_model'));

		cekLogin();
	}

	public function index()
	{
		$data['bank'] = $this->Bank_model->get_by_id_join($this->session->userdata('cd_id'));

		$this->load->view('templates/header');
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('kabinet/bank', $data);
		$this->load->view('templates/footer');
	}

	public function save()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => []];

			$this->form_validation->set_rules('bank', 'Bank', 'trim|required|xss_clean');
			$this->form_validation->set_rules('no_rekening', 'No Rekening', 'trim|required|xss_clean');
			$this->form_validation->set_rules('atas_nama', 'Atas Nama', 'trim|required|xss_clean');
			$this->form_validation->set_rules('cabang', 'Atas Nama', 'trim|xss_clean');
			$this->form_validation->set_rules('kode_bank', 'Swift Code', 'trim|xss_clean');
			$this->form_validation->set_rules('jenis_rekening', 'Jenis Rekening', 'trim|required|xss_clean');
			$this->form_validation->set_rules('tlp', 'Telepon Bank', 'trim|numeric');
			// $this->form_validation->set_rules('image', 'Buku Tabungan', 'callback_upload');

			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				// Start database transaction
				$this->db->trans_begin();

				$bankIDR = array(
					'nasabah_id' => $this->session->userdata('cd_id'),
					'nama_bank' => $this->input->post('bank', TRUE),
					'no_rekening' => $this->input->post('no_rekening', TRUE),
					'cabang' => $this->input->post('cabang', TRUE),
					'jenis_rekening' => $this->input->post('jenis_rekening', TRUE),
					'telepon_bank' => $this->input->post('tlp', TRUE),
					'kode_bank' => $this->input->post('kode_bank', TRUE),
					'atas_nama' => $this->input->post('atas_nama', TRUE),
					'currency' => $this->input->post('currency', TRUE),
					// 'gambar' => $_POST['image'],
					'created_date' => date('Y-m-d h:i:s'),
					'status_bank' => 'Pending',
				);
				$bankid = $this->Bank_model->insert($bankIDR);
				$bank_id = $this->db->insert_id();

				$dataLog = array(
					'nasabah_id' => $this->session->userdata('cd_id'),
					'bank_id' => $bankid,
					'type' => 'Bank',
					'read_status' => 'N',
					'aktifitas' => 'Pengajuan akun bank baru'
				);
				$this->Log_model->insert($dataLog);

				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					$json['alert'] = 'Pengajuan penambahan akun rekening bank gagal';
				} else {
					// Upload gambar
					$upld = $this->upload();
					if ($upld['is_uploaded'] == TRUE) { // Jika upload berhasil
						$this->db->trans_commit();

						$this->db->update('bank', ['gambar' => $upld['file_name']], ['bank_id' => $bank_id]);

						// kirim email pemberitahuan ke Admin
						$this->load->helper('send_email_helper');
						$data_email['email'] = 'manager@tifia.co.id';
						$data_email['pesan'] = 'Dear admin, Nasabah atas nama ' . $this->session->userdata('nsb_nama') . ' mengajukan akun bank baru. Mohon untuk segera melakukan approval';
						$data_email['subjek'] = 'Pengajuan Akun Bank Baru';
						send_mailer($data_email);

						$json['success'] = true;
						$json['alert'] = 'Pengajuan penambahan akun rekening bank berhasil ditambahkan, mohon untuk menunggu approval admin';
						$json['href'] = base_url('bank');
					} else { // Jika upload gagal
						$this->db->trans_rollback();
						$json['alert'] = $upld['error'];
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

	/**
	 * @return bool
	 */
	private function upload()
	{
		$var = ['is_uploaded' => false, 'file_name' => '', 'error' => ''];

		$config['upload_path'] = './uploads/buku_tabungan/';
		$config['max_size'] = 1024 * 2;
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
			if ($this->upload->do_upload('image')) {
				$upload_data = $this->upload->data();
				$var['file_name'] = $upload_data['file_name'];
				$var['is_uploaded'] = TRUE;
			} else {
				$this->form_validation->set_message('validate_image', $this->upload->display_errors());
				$var['error'] = $this->upload->display_errors();
			}
		} else {
			$_POST['file'] = NULL;
			$var['error'] = 'Tidak ada gambar';
		}

		return $var;
	}

	public function getBankDetail()
	{
		$bankid = $this->input->post('bankid');
		$data = $this->Bank_model->get_by_id($bankid);
		// $data = $data['harga'];
		echo json_encode($data);
	}
}
