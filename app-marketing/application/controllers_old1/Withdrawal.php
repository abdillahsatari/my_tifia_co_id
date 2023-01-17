<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Withdrawal extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Withdraw_model', 'Bank_model', 'Acc_trading_model', 'Log_model'));
		cekLogin();
	}

	public function index()
	{
		//load akun real nasabah
		$data['akun'] = $this->Acc_trading_model->get_by_id_nasabah($this->session->userdata('cd_id'));
		//load data bank nasabah
		$data['bank'] = $this->Bank_model->get_all_where('nasabah_id', $this->session->userdata('cd_id'));
		$data['wd'] = $this->Withdraw_model->get_by_id_nasabah($this->session->userdata('cd_id'));

		$this->load->view('templates/header');
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('kabinet/withdrawal', $data);
		$this->load->view('templates/footer');
	}

	public function save()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			$this->form_validation->set_rules('no_akun_wd', 'no akun', 'trim|required'); // no_akun
			$this->form_validation->set_rules('bank_select', 'bank', 'trim|required'); // bank_id
			$this->form_validation->set_rules('jumlah_usd', 'jumlah', 'trim|required|numeric|greater_than[0]');
			// $this->form_validation->set_rules('jumlah', 'Jumlah Withdraw', 'trim|required|numeric');
			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {

				$json['form_validation'] = TRUE;

				// Start database transaction
				$this->db->trans_start();

				$date = new_date();

				// get withdraw rate
				$query = $this->db->query('SELECT acc_currency.withdraw_rate FROM acc_trading, acc_currency WHERE acc_trading.acc_currency_id=acc_currency.acc_currency_id AND acc_trading.no_akun="' . $this->input->post('no_akun_wd', TRUE) . '"')->row_array();
				$wd_rate = $query['withdraw_rate'];

				$jumlah_usd = $this->input->post('jumlah_usd', TRUE);
				$jumlah_idr = $jumlah_usd * $wd_rate;

				$jmlWD = $this->Withdraw_model->get_count();
				$jmlWD = $jmlWD + 1;
				$no_WD = 'WD' . date('Ymd', strtotime($date)) . generate_kd(4, $jmlWD);

				//input data deposit
				$wddata = array(
					'withdraw_id' => $no_WD,
					'nasabah_id' => $this->session->userdata('cd_id'),
					'bank_id' => $this->input->post('bank_select', TRUE),
					'no_akun' => $this->input->post('no_akun_wd', TRUE),
					'total' => $jumlah_idr,
					'status_withdraw' => 'Pending',
					'sumber_withdraw' => 'Akun Trading',
					'tanggal_withdraw' => $date
				);
				$this->Withdraw_model->insert($wddata);

				$dataLog = array(
					'nasabah_id' => $this->session->userdata('cd_id'),
					'withdraw_id' => $no_WD,
					'type' => 'Withdraw',
					'read_status' => 'N',
					'aktifitas' => 'Melakukan Penarikan'
				);
				$this->Log_model->insert($dataLog);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Penarikan gagal.';
				} else {

					// send whatsapp
					$this->Rapiwha->send_fromAdmin('Notifikasi: Nasabah dengan akun ' . $this->session->userdata('nsb_email') . ' melakukan withdrawal dari akun trading ' . $wddata['no_akun'] . ' dengan total ' . $wddata['total'] . '. Mohon untuk segera melakukan approval.', 3);

					// send email ke admin
					$this->load->helper('send_email_helper');
					$email['email'] = 'romy@tifia.co.id';
					$email['subjek'] = 'Nasabah Withdraw';
					$email['pesan'] = 'Dear admin, Nasabah atas nama ' . $this->session->userdata('nsb_nama') . ' melakukan withdrawal dari akun trading ' . $wddata['no_akun'] . ' dengan total ' . $wddata['total'] . '. Mohon untuk segera melakukan approval';
					send_mailer($email);

					$json['success'] = true;
					$json['alert'] = 'Pengajuan penarikan berhasil. Admin akan memeriksa pengajuan penarikan anda.';
					$json['href'] = base_url() . 'withdrawal';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}
}
