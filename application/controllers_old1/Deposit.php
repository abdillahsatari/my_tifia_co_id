<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deposit extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Deposit_model', 'Bank_model', 'Acc_trading_model', 'Log_model'));
		cekLogin();
	}

	public function index()
	{
		// load akun real nasabah
		$data['akun'] = $this->Acc_trading_model->get_by_id_nasabah($this->session->userdata('cd_id'));
		// load data bank nasabah
		$data['bank'] = $this->Bank_model->get_all_where('nasabah_id', $this->session->userdata('cd_id'));
		// load gateway tujuan transfer
		$data['gateway'] = $this->db->query('SELECT * FROM gateway WHERE is_active="1" AND is_deleted="0"')->result();
		$data['deposit'] = $this->Deposit_model->get_by_id_nasabah($this->session->userdata('cd_id'));

		$this->load->view('templates/header');
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('kabinet/deposit', $data);
		$this->load->view('templates/footer');
	}

	public function detail($deposit_id)
	{
		$qry = $this->db->query('SELECT * FROM deposit WHERE id="' . $deposit_id . '" AND nasabah_id="' .  $this->session->userdata('cd_id') . '"');

		if ($qry->num_rows() > 0) {
			$main['data'] = $qry->row_array();

			// get rekening tujuan
			$main['gateway'] = $this->db->query('SELECT * FROM gateway WHERE id="' . $main['data']['gateway_id'] . '"')->row_array();
			// get rekening saya
			$main['rekening'] = $this->db->query('SELECT * FROM bank WHERE bank_id="' . $main['data']['bank_id'] . '"')->row_array();

			$this->load->view('templates/header');
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('kabinet/deposit_detail', $main);
			$this->load->view('templates/footer');
		}
	}

	public function save()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => []];
			$this->form_validation->set_rules('no_akun', 'no akun', 'trim|required');
			$this->form_validation->set_rules('bank', 'bank', 'trim|required|numeric');
			$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required|numeric|greater_than[0]');
			$this->form_validation->set_rules('gateway_id', 'rekening tujuan', 'trim|required|numeric');
			// $this->form_validation->set_rules('image', 'Bukti Transfer', 'callback_upload');
			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = true;

				$nsb_id = $this->session->userdata('cd_id');

				// Start database transaction
				$this->db->trans_start();

				$date = new_date();

				// cek jika telah deposit dengan no_akun yang sama
				$jumlah_dp = $this->db->query('SELECT * FROM deposit WHERE no_akun="' . $this->input->post('no_akun', TRUE) . '" AND nasabah_id="' . $nsb_id . '" AND status_deposit="Approve"')->num_rows();
				if ($jumlah_dp > 0) {
					$type = 'Topup';
				} else {
					$type = 'Awal';
				}

				//input data deposit
				$depositdata = array(
					'deposit_id' => 'DP' . date('Ymd', strtotime($date)),
					'nasabah_id' => $nsb_id,
					'gateway_id' => $this->input->post('gateway_id', TRUE),
					'bank_id' => $this->input->post('bank', TRUE),
					'total' =>  $this->input->post('jumlah', TRUE),
					'kode_unik' => rand(100, 999),
					'type_deposit' => $type,
					'status_deposit' => 'Pending',
					'no_akun' => $this->input->post('no_akun', TRUE),
					'tanggal_deposit' => $date
				);
				$this->Deposit_model->insert($depositdata);
				$id_dp = $this->db->insert_id();

				$kode = 'DP' . strtotime($date) . generate_kd(4, $id_dp);
				$this->db->update('deposit', ['deposit_id' => $kode], ['id' => $id_dp]);

				$dataLog = array(
					'nasabah_id' => $nsb_id,
					'deposit_id' => $id_dp,
					'type' => 'Deposit',
					'read_status' => 'N',
					'aktifitas' => 'Melakukan Request Penyetoran ' . $type
				);
				$this->Log_model->insert($dataLog);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Request penyetoran gagal';
					$er = $this->db->error();
					$json['error'] = $er['message'];
				} else {

					// send whatsapp
					$this->Rapiwha->send_fromAdmin('Notifikasi: Nasabah dengan akun ' . $this->session->userdata('nsb_email') . ' melakukan deposit,' . $depositdata['type_deposit'] . ' dengan total IDR' . $depositdata['total'] . '. Mohon untuk segera melakukan approval.', 3);

					// kirim email pemberitahuan ke Admin
					$this->load->helper('send_email_helper');
					$data_email['email'] = 'romy@tifia.co.id';
					$data_email['subjek'] = 'Nasabah Deposit';
					$data_email['pesan'] = 'Dear admin, Nasabah atas nama ' . $this->session->userdata('nsb_nama') . ' melakukan deposit,' . $depositdata['type_deposit'] . ' dengan total IDR' . $depositdata['total'] . '. Mohon untuk segera melakukan approval';
					send_mailer($data_email);

					$json['success'] = true;
					$json['alert'] = 'Request penyetoran berhasil. Mohon untuk segera mengunggah bukti transfer agas setoranmu dapat diproses!';
					$json['href'] = base_url('deposit/detail/' . $id_dp);
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	public function upload($id_dp)
	{
		$qry = $this->db->query('SELECT * FROM deposit WHERE id="' . $id_dp . '" AND nasabah_id="' .  $this->session->userdata('cd_id') . '"');
		if ($qry) {
			$result = $qry->row_array();

			$config['upload_path'] = './uploads/bukti_tf/';
			$config['max_size'] = 1024 * 2;
			$config['allowed_types'] = 'png|jpg|jpeg';
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
				if ($this->upload->do_upload('image')) {
					$upload_data = $this->upload->data();

					// hapus gambar lama jika ada
					if ($result['bukti_transfer'] != '' && $result['bukti_transfer'] != null) {
						$path = 'uploads/bukti_tf/' .  $result['bukti_transfer'];
						if (file_exists($path)) {
							unlink($path);
						}
					}

					// update
					$this->db->update('deposit', ['bukti_transfer' => $upload_data['file_name']], ['id' => $id_dp]);

					flash_alert('Upload bukti transfer berhasil.');
				} else {
					flash_alert('Upload bukti transfer gagal. ' . $this->upload->display_errors(), 'danger');
				}
			} else {
				flash_alert('Upload bukti transfer gagal. Pilih gambar terlebih dahulu.', 'danger');
			}

			redirect('deposit/detail/' . $id_dp);
		}
	}
}
