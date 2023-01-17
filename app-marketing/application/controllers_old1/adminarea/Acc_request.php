<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Acc_request extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model('Acc_request_model');
		$this->load->model('Acc_demo_model');
		$this->load->model('Acc_trading_model');
		$this->load->model('Users_pesan_model');
		$this->load->model('Log_model');
		$this->load->model('Nasabah_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}

	public function index()
	{
		$data['title'] = 'Acc Request';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Acc Request' => '',
		];
		$data['code_js'] = 'acc_request/codejs';
		$data['page'] = 'acc_request/acc_request_list';
		$this->load->view('template/backend', $data);
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Acc_request_model->json();
	}

	public function read($id)
	{
		$row = $this->Acc_request_model->get_by_id_join($id);
		if ($row) {
			$data = array(
				'acc_request_id' => $row->acc_request_id,
				'nasabah_id' => $row->nasabah_id,
				'nama_lengkap' => $row->nama_lengkap,
				'email' => $row->email,
				'acc_currency_id' => $row->acc_currency_id,
				'currency' => $row->nama_currency,
				'acc_type_id' => $row->acc_type_id,
				'type' => $row->type,
				'acc_leverage_id' => $row->acc_leverage_id,
				'leverage' => $row->nama_leverage,
				'date' => $row->date,
				'status_request' => $row->status_request,
			);
			$data['title'] = 'Acc Request';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			$data['page'] = 'acc_request/acc_request_read';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('acc_request'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('adminarea/acc_request/create_action'),
			'acc_request_id' => set_value('acc_request_id'),
			'nasabah_id' => set_value('nasabah_id'),
			'acc_currency_id' => set_value('acc_currency_id'),
			'acc_type_id' => set_value('acc_type_id'),
			'acc_leverage_id' => set_value('acc_leverage_id'),
			'date' => set_value('date'),
			'status_request' => set_value('status_request'),
		);
		$data['title'] = 'Acc Request';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Dashboard' => '',
		];

		$data['page'] = 'acc_request/acc_request_form';
		$this->load->view('template/backend', $data);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'nasabah_id' => $this->input->post('nasabah_id', TRUE),
				'acc_currency_id' => $this->input->post('acc_currency_id', TRUE),
				'acc_type_id' => $this->input->post('acc_type_id', TRUE),
				'acc_leverage_id' => $this->input->post('acc_leverage_id', TRUE),
				'date' => $this->input->post('date', TRUE),
				'status_request' => $this->input->post('status_request', TRUE),
			);
		}
		$this->Acc_request_model->insert($data);
		$this->session->set_flashdata('message', 'Create Record Success');
		redirect(site_url('adminarea/acc_request'));
	}

	public function update($id)
	{
		$row = $this->Acc_request_model->get_by_id_join($id);
		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('adminarea/acc_request/update_action'),
				'acc_request_id' => set_value('acc_request_id', $row->acc_request_id),
				'nasabah_id' => set_value('nasabah_id', $row->nasabah_id),
				'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
				'email' => set_value('email', $row->email),
				'acc_currency_id' => set_value('acc_currency_id', $row->acc_currency_id),
				'nama_currency' => set_value('nama_currency', $row->nama_currency),
				'acc_type_id' => set_value('acc_type_id', $row->acc_type_id),
				'type' => set_value('type', $row->type),
				'acc_leverage_id' => set_value('acc_leverage_id', $row->acc_leverage_id),
				'nama_leverage' => set_value('nama_leverage', $row->nama_leverage),
				'date' => set_value('date', $row->date),
				'status_request' => set_value('status_request', $row->status_request),

				// 'action' => site_url('adminarea/acc_trading/create_action'),
				'no_akun' => set_value('no_akun'),
				'acc_currency_id' => set_value('acc_currency_id'),
				'acc_leverage_id' => set_value('acc_leverage_id'),
				'nasabah_id' => set_value('nasabah_id'),
				'acc_type' => set_value('acc_type'),
				'komisi' => set_value('komisi'),
				'percent_req' => set_value('percent_req'),
				'password_trade' => set_value('password_trade'),
				'password_investor' => set_value('password_investor'),
				'ip' => set_value('ip'),
				'port' => set_value('port'),
				'tanggal_buat_akun' => set_value('tanggal_buat_akun'),
				'tanggal_terakhir_login' => set_value('tanggal_terakhir_login'),
				'status_aktif' => set_value('status_aktif'),
				'id_operator' => set_value('id_operator'),
				'balance' => set_value('balance'),
			);
			$data['title'] = 'Acc Request';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			if ($row->jenis == 'Real') {
				if ($row->status == 'Register') {
					$this->session->set_flashdata('message', 'Nasabah belum menyelesaikan registrasi complete!');
					redirect(site_url('adminarea/acc_request'));
				} elseif ($row->status == 'Complete' || $row->status == 'Checking') {
					$this->session->set_flashdata('message', 'Data nasabah belum di approve!');
					redirect(site_url('adminarea/acc_request'));
				} else {
					$data['page'] = 'acc_request/acc_request_form';
					$this->load->view('template/backend', $data);
				}
			} elseif ($row->jenis == 'Demo') {
				$data['page'] = 'acc_request/acc_request_form';
				$this->load->view('template/backend', $data);
			}
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/acc_request'));
		}
	}

	public function update_action()
	{
		//data user login
		$user = $this->ion_auth->user()->row();

		$row = $this->Acc_request_model->get_by_id_join($this->input->post('acc_request_id', TRUE));

		// $this->_rules();

		$this->form_validation->set_rules('password_trade', 'password trade', 'trim|required');
		$this->form_validation->set_rules('password_investor', 'password investor', 'trim|required');
		$this->form_validation->set_rules('ip', 'ip', 'trim');
		// $this->form_validation->set_rules('port', 'port', 'trim|required');
		// $this->form_validation->set_rules('no_akun', 'no akun', 'trim|required');
		if ($row->jenis == 'Demo') {
			$this->form_validation->set_rules(
				'no_akun',
				'no akun',
				'trim|required|is_unique[acc_demo.no_akun]',
				array('is_unique' => 'Nomor Akun sudah ada!')
			);
		} elseif ($row->jenis == 'Real') {
			$this->form_validation->set_rules(
				'no_akun',
				'no akun',
				'trim|required|is_unique[acc_trading.no_akun]',
				array('is_unique' => 'Nomor Akun sudah ada!')
			);
		}

		$this->form_validation->set_rules('acc_request_id', 'acc_request_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('acc_request_id', TRUE));
		} else {
			//0. mendapatkan data request akun berdasarkan id request akun
			$dataAcc = array(
				'acc_request_id' => $this->input->post('acc_request_id', TRUE),
				'acc_currency_id' => $row->acc_currency_id,
				'acc_leverage_id' => $row->acc_leverage_id,
				'nasabah_id' => $row->nasabah_id,
				'acc_type_id' => $row->acc_type_id,
				'no_akun' => $this->input->post('no_akun', TRUE),
				'password_trade' => $this->input->post('password_trade', TRUE),
				'password_investor' => $this->input->post('password_investor', TRUE),
				'ip' => $this->input->post('ip', TRUE),
				'port' => $this->input->post('port', TRUE),
				'tanggal_buat_akun' => date('Y-m-d h:i:s'),
				'status_aktif' => 'Aktif',
				'user_id' => $user->id,
			);
			//jika tipe akunnya demo
			if ($row->jenis == 'Demo') {
				//1. memasukkan data ke tabel acc_demo
				$dataAcc['deposit'] = $row->deposit;
				$this->Acc_demo_model->insert($dataAcc);

				//subject email ke nasabah
				$subject = 'Akun Demo yang anda request telah dikonfirmasi';
			}
			//jika tipe akun bukan demo (akun real : standard &/ mini)
			else {
				//1. memasukkan data ke tabel acc_trading
				$this->Acc_trading_model->insert($dataAcc);

				//subject email ke nasabah
				$subject = 'Akun Real yang anda request telah dikonfirmasi';
				if ($row->status == 'Approved') {
					$dataStat = array('status' => 'Active');
					$this->Nasabah_model->update($row->nasabah_id, $dataStat);
				}
			}
			//2. Update status request menjadi Done
			$dataReq = array(
				'status_request' => 'Aktif',
				'user_id' => $user->id
			);
			$this->Acc_request_model->update($this->input->post('acc_request_id', TRUE), $dataReq);
			//3. kirim email ke nasabah informasi akun tradingnya dan input email ke db


			$isi_email = [
				'nama' => $row->nama_lengkap,
				'type' => $row->type,
				'nama_currency' => $row->nama_currency,
				'Leverage' => $row->nama_leverage,
				'email' => $row->email,
				'no_akun' =>  $dataAcc['no_akun'],
				'password_trade' => $dataAcc['password_trade'],
				'ip' => $dataAcc['ip']
			];

			$this->load->helper('send_email_helper');
			$data_email['email'] = $row->email;
			$data_email['pesan'] = $this->getEmailBody($isi_email);
			$data_email['subjek'] = $subject;
			send_mailer($data_email);

			//isi email ke nasabah
			// if ($row->nama_lengkap == NULL) {
			// 	$nama = $row->email;
			// } else {
			// 	$nama = $row->nama_lengkap;
			// }
			// $isi = "Dear " . $nama . ", Admin telah membuatkan akun trading yang anda Request, yaitu : <p>
			//         Tipe Akun : " . $row->type . "<p>
			//         Nilai Tukar : " . $row->nama_currency . "<p>
			//         Leverage : " . $row->nama_leverage . "<p>
			//         <br>
			//         No Akun : " . $dataAcc['no_akun'] . "<p>
			//         Password :" . $dataAcc['password_trade'] . "<p>
			//         Password Investor : " . $dataAcc['password_investor'] . "<p>
			//         Server : " . $dataAcc['ip'] . "<p>
			//         <br>
			//         Terimakasih, 
			//         <br>
			//         RTF";

			// $this->_sendEmail($row->email, $subject, $isi);

			// $dataEmail = array(
			// 	'nasabah_id' => $row->nasabah_id,
			// 	'subject' => $subject,
			// 	'isi' => $isi,
			// 	'user_id' => $user->id
			// );
			// $this->Users_pesan_model->insert($dataEmail);



			//4. masukkan aktifitas ke users_log
			if ($row->jenis == 'Demo') {
				$dataLog = array(
					'user_id' => $user->id,
					'nasabah_id' => $row->nasabah_id,
					'acc_request_id' => $this->input->post('acc_request_id', TRUE),
					'no_akun_demo' => $this->input->post('no_akun', TRUE),
					'type' => 'Create Akun Trading Demo',
					'read_status' => 'Y',
					'aktifitas' => 'Membuat Akun Trading Demo'
				);
			} else {
				$dataLog = array(
					'user_id' => $user->id,
					'nasabah_id' => $row->nasabah_id,
					'acc_request_id' => $this->input->post('acc_request_id', TRUE),
					'no_akun' => $this->input->post('no_akun', TRUE),
					'type' => 'Create Akun Trading Real',
					'read_status' => 'Y',
					'aktifitas' => 'Membuat Akun Trading Real'
				);
			}
			$this->Log_model->insert_admin($dataLog);
			//5. lempar ke halaman (demo : acc_demo, real : acc_trading)

			if ($row->jenis == 'Demo') {
				redirect(site_url('adminarea/acc_demo'));
			} else {
				redirect(site_url('adminarea/acc_trading'));
			}
		}
	}




	private function getEmailBody($data)
	{
		$msg = $this->load->view('template_email/email_account_real', ['user' => $data], true);

		return $msg;
	}






	private function _sendEmail($email, $subject, $pesan)
	{
		// Load helper email dan konfigurasinya
		$this->load->helper('send_email_helper');
		$email['email'] = $email;
		$email['subjek'] = $subject;
		$email['pesan'] = $pesan;
		$msg = send_mailer($email);

		// Tampilkan pesan sukses atau error
		if ($msg['is_sent'] == TRUE) {
			return true;
		} else {
			echo $msg['error'];
			die();
		}
	}

	public function delete($id)
	{
		$row = $this->Acc_request_model->get_by_id($id);

		if ($row) {
			$this->Acc_request_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('adminarea/acc_request'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/acc_request'));
		}
	}

	public function deletebulk()
	{
		$delete = $this->Acc_request_model->deletebulk();
		if ($delete) {
			$this->session->set_flashdata('message', 'Delete Record Success');
		} else {
			$this->session->set_flashdata('message_error', 'Delete Record failed');
		}
		echo $delete;
	}

	public function _rules()
	{
		// $this->form_validation->set_rules('nasabah_id', 'nasabah id', 'trim|required');
		// $this->form_validation->set_rules('acc_currency_id', 'acc currency id', 'trim|required');
		// $this->form_validation->set_rules('acc_type_id', 'acc type id', 'trim|required');
		// $this->form_validation->set_rules('acc_leverage_id', 'acc leverage id', 'trim|required');
		// $this->form_validation->set_rules('date', 'date', 'trim|required');
		// $this->form_validation->set_rules('status_request', 'status request', 'trim|required');


		$this->form_validation->set_rules('password_trade', 'password trade', 'trim|required');
		$this->form_validation->set_rules('password_investor', 'password investor', 'trim|required');
		$this->form_validation->set_rules('ip', 'ip', 'trim');
		// $this->form_validation->set_rules('port', 'port', 'trim|required');
		$this->form_validation->set_rules('no_akun', 'no akun', 'trim|required');

		$this->form_validation->set_rules('acc_request_id', 'acc_request_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "acc_request.xls";
		$judul = "acc_request";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Nasabah");
		xlsWriteLabel($tablehead, $kolomhead++, "Email Nasabah");
		xlsWriteLabel($tablehead, $kolomhead++, "Tipe Akun");
		xlsWriteLabel($tablehead, $kolomhead++, "Nilai Tukar");
		xlsWriteLabel($tablehead, $kolomhead++, "Leverage");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Request");
		xlsWriteLabel($tablehead, $kolomhead++, "Status Request");

		foreach ($this->Acc_request_model->get_all() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
			xlsWriteLabel($tablebody, $kolombody++, $data->email);
			xlsWriteLabel($tablebody, $kolombody++, $data->type);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_currency);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_leverage);
			xlsWriteLabel($tablebody, $kolombody++, $data->date);
			xlsWriteLabel($tablebody, $kolombody++, $data->status_request);

			$tablebody++;
			$nourut++;
		}

		xlsEOF();
		exit();
	}

	public function word()
	{
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=acc_request.doc");

		$data = array(
			'acc_request_data' => $this->Acc_request_model->get_all(),
			'start' => 0
		);

		$this->load->view('acc_request/acc_request_doc', $data);
	}

	public function printdoc()
	{
		$data = array(
			'acc_request_data' => $this->Acc_request_model->get_all(),
			'start' => 0
		);
		$this->load->view('acc_request/acc_request_print', $data);
	}
}

/* End of file Acc_request.php */
/* Location: ./application/controllers/Acc_request.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-17 07:29:59 */
/* http://harviacode.com */
