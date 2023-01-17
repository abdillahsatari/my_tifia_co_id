<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Deposit extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model('Deposit_model');
		$this->load->model('Users_pesan_model');
		$this->load->model('Log_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}

	public function index()
	{
		$data['title'] = 'Deposit';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Deposit' => '',
		];
		$data['code_js'] = 'deposit/codejs';
		$data['page'] = 'deposit/deposit_list';
		$this->load->view('template/backend', $data);
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Deposit_model->json();
	}

	public function read($id)
	{
		$row = $this->Deposit_model->get_by_id_join($id);
		if ($row) {
			$data = array(
				'deposit_id' => $row->deposit_id,
				'no_akun' => $row->no_akun,
				'currency' => $row->nama_currency,
				'deposit' => $row->deposit_rate,
				'nasabah_id' => $row->nasabah_id,
				'nama' => $row->nama_lengkap,
				'email' => $row->email,
				'bank_id' => $row->bank_id,
				'bank' => $row->nama_bank,
				'no_rekening' => $row->no_rekening,
				'atas_nama' => $row->atas_nama,
				'currency_bank' => $row->currency,
				'total' => $row->total,
				'acc_currency_id' => $row->acc_currency_id,
				'bukti_transfer' => $row->bukti_transfer,
				'type_deposit' => $row->type_deposit,
				'status_deposit' => $row->status_deposit,
				'tanggal_deposit' => $row->tanggal_deposit,
			);
			$data['title'] = 'Deposit';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			$data['page'] = 'deposit/deposit_read';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('deposit'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('adminarea/deposit/create_action'),
			'deposit_id' => set_value('deposit_id'),
			'no_akun' => set_value('no_akun'),
			'nasabah_id' => set_value('nasabah_id'),
			'bank_id' => set_value('bank_id'),
			'total' => set_value('total'),
			'acc_currency_id' => set_value('acc_currency_id'),
			'bukti_transfer' => set_value('bukti_transfer'),
			'type_deposit' => set_value('type_deposit'),
			'status_deposit' => set_value('status_deposit'),
			'tanggal_deposit' => set_value('tanggal_deposit'),
			'id_operator' => set_value('id_operator'),
		);
		$data['title'] = 'Deposit';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Dashboard' => '',
		];

		$data['page'] = 'deposit/deposit_form';
		$this->load->view('template/backend', $data);
	}

	public function create_action()
	{
		$this->_rules();
		$user = $this->ion_auth->user()->row();
		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'no_akun' => $this->input->post('no_akun', TRUE),
				'nasabah_id' => $this->input->post('nasabah_id', TRUE),
				'bank_id' => $this->input->post('bank_id', TRUE),
				'total' => $this->input->post('total', TRUE),
				'acc_currency_id' => $this->input->post('acc_currency_id', TRUE),
				'bukti_transfer' => $this->input->post('bukti_transfer', TRUE),
				'type_deposit' => $this->input->post('type_deposit', TRUE),
				'status_deposit' => $this->input->post('status_deposit', TRUE),
				'tanggal_deposit' => $this->input->post('tanggal_deposit', TRUE),
				'id_operator' => $this->input->post('id_operator', TRUE),
			);
		}
		$depositId = $this->Deposit_model->insert_id($data);
		//4. masukkan ke log user
		$dataLog = array(
			'user_id' => $user->id,
			'nasabah_id' => $this->input->post('nasabah_id', TRUE),
			'deposit_id' => $depositId,
			'type' => 'Deposit',
			'read_status' => 'N',
			'aktifitas' => 'Melakukan Deposit'
		);
		$id = $this->Log_model->insert($dataLog);
		$this->session->set_flashdata('message', 'Create Record Success');
		redirect(site_url('adminarea/deposit'));
	}

	public function update($id)
	{
		$row = $this->Deposit_model->get_by_id_join($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('adminarea/deposit/update_action'),

				'deposit_id' => set_value('deposit_id', $row->deposit_id),
				'no_akun' => set_value('no_akun', $row->no_akun),
				'currency' => set_value('currency', $row->nama_currency),
				'deposit' => set_value('deposit', $row->deposit_rate),

				'nasabah_id' => set_value('nasabah_id', $row->nasabah_id),
				'nama' => set_value('nama', $row->nama_lengkap),
				'email' => set_value('email', $row->email),

				'bank_id' => set_value('bank_id', $row->bank_id),
				'bank' => set_value('bank', $row->nama_bank),
				'no_rekening' => set_value('no_rekening', $row->no_rekening),
				'atas_nama' => set_value('atas_nama', $row->atas_nama),
				'currency_bank' => set_value('currency_bank', $row->currency),

				'total' => set_value('total', $row->total),
				'acc_currency_id' => set_value('acc_currency_id', $row->acc_currency_id),
				'bukti_transfer' => set_value('bukti_transfer', $row->bukti_transfer),
				'type_deposit' => set_value('type_deposit', $row->type_deposit),
				'status_deposit' => set_value('status_deposit', $row->status_deposit),
				'tanggal_deposit' => set_value('tanggal_deposit', $row->tanggal_deposit),

				'komentar' => set_value('komentar', $row->komen),
			);
			$data['title'] = 'Deposit';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			$data['page'] = 'deposit/deposit_form';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/deposit'));
		}
	}

	public function update_action()
	{
		// $this->_rules();
		$user = $this->ion_auth->user()->row();

		$this->form_validation->set_rules('status_deposit', 'status deposit', 'trim|required');
		if ($this->input->post('status_deposit', TRUE) == 'Reject') {
			$this->form_validation->set_rules('komentar', 'komentar', 'trim|required');
		}

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('deposit_id', TRUE));
		} else {

			$dp_id = $this->input->post('deposit_id', TRUE);

			$query = $this->db->query("SELECT * FROM deposit WHERE deposit_id='$dp_id'")->row_array();

			if ($query) {

				// Start database transaction
				$this->db->trans_begin();

				//1. update data deposit
				$data = array(
					'status_deposit' => $this->input->post('status_deposit', TRUE),
					'komen' => $this->input->post('komentar', TRUE),
					'tanggal_konfirmasi' => new_date(),
				);
				$this->Deposit_model->update($dp_id, $data);

				//2. kirim email ke nasabah
				$nsb_id = $query['nasabah_id'];
				$nsb =  $this->db->query("SELECT nama_lengkap, email FROM nasabah WHERE nasabah_id='$nsb_id'")->row_array();

				// $this->Users_pesan_model->insert($dataEmail);
				//4. masukkan ke log user
				$dataLog = array(
					'user_id' => $user->id,
					'nasabah_id' => $this->input->post('nasabah_id', TRUE),
					'deposit_id' => $this->input->post('deposit_id', TRUE),
					'type' => 'Deposit',
					'read_status' => 'N',
					'aktifitas' => 'Approval Deposit'
				);
				$this->Log_model->insert_admin($dataLog);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$this->session->set_flashdata('message', 'Update Record Gagal');
				} else {

					$status = $this->input->post('status_deposit', TRUE);
					if ($status == 'Approve' || $status == 'Reject') {

						$data['amount'] = $query['total'];

						$isi_email = [
							'kode' => $dp_id,
							'nama' => $nsb['nama_lengkap'],
							'judul' => 'Setoran ' . $status,
							'pesan' => 'Setoran anda dengan kode [' .  $dp_id  . '] ' . ($status == 'Approve' ? 'telah dikonfirmasi, sebagai berikut' : 'ditolak'),
							'data' => $data,
						];

						$this->load->helper('send_email_helper');
						$data_email['email'] = $nsb['email'];
						$data_email['pesan'] = $this->load->view('template_email/email_mkt_dp', $isi_email, true);
						$data_email['subjek'] = "Setoran " . $status;
						send_mailer($data_email);
					}

					$this->session->set_flashdata('message', 'Update Record Success');
				}
			}
			redirect(site_url('adminarea/deposit'));
		}
	}

	public function delete($id)
	{
		$row = $this->Deposit_model->get_by_id($id);

		if ($row) {
			$this->Deposit_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('adminarea/deposit'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/deposit'));
		}
	}

	public function deletebulk()
	{
		$delete = $this->Deposit_model->deletebulk();
		if ($delete) {
			$this->session->set_flashdata('message', 'Delete Record Success');
		} else {
			$this->session->set_flashdata('message_error', 'Delete Record failed');
		}
		echo $delete;
	}

	public function _rules()
	{
		$this->form_validation->set_rules('no_akun', 'no akun', 'trim|required');
		$this->form_validation->set_rules('nasabah_id', 'nasabah id', 'trim|required');
		$this->form_validation->set_rules('bank_id', 'bank id', 'trim|required');
		$this->form_validation->set_rules('total', 'total', 'trim|required|numeric');
		$this->form_validation->set_rules('acc_currency_id', 'acc currency id', 'trim|required');
		$this->form_validation->set_rules('bukti_transfer', 'bukti transfer', 'trim|required');
		$this->form_validation->set_rules('type_deposit', 'type deposit', 'trim|required');
		$this->form_validation->set_rules('status_deposit', 'status deposit', 'trim|required');
		$this->form_validation->set_rules('tanggal_deposit', 'tanggal deposit', 'trim|required');
		$this->form_validation->set_rules('id_operator', 'id operator', 'trim|required');

		$this->form_validation->set_rules('deposit_id', 'deposit_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "deposit.xls";
		$judul = "deposit";
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
		xlsWriteLabel($tablehead, $kolomhead++, "No Akun");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Nasabah");
		xlsWriteLabel($tablehead, $kolomhead++, "Email Nasabah");
		xlsWriteLabel($tablehead, $kolomhead++, "Total");
		xlsWriteLabel($tablehead, $kolomhead++, "Type Deposit");
		xlsWriteLabel($tablehead, $kolomhead++, "Status Deposit");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Deposit");

		foreach ($this->Deposit_model->get_by_all_join() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteNumber($tablebody, $kolombody++, $data->no_akun);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
			xlsWriteLabel($tablebody, $kolombody++, $data->email);
			xlsWriteNumber($tablebody, $kolombody++, number_format($data->total));
			xlsWriteLabel($tablebody, $kolombody++, $data->type_deposit);
			xlsWriteLabel($tablebody, $kolombody++, $data->status_deposit);
			xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_deposit);

			$tablebody++;
			$nourut++;
		}

		xlsEOF();
		exit();
	}

	public function word()
	{
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=deposit.doc");

		$data = array(
			'deposit_data' => $this->Deposit_model->get_by_all_join(),
			'start' => 0
		);

		$this->load->view('deposit/deposit_doc', $data);
	}

	public function printdoc()
	{
		$data = array(
			'deposit_data' => $this->Deposit_model->get_by_all_join(),
			'start' => 0
		);
		$this->load->view('deposit/deposit_print', $data);
	}
}

/* End of file Deposit.php */
/* Location: ./application/controllers/Deposit.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-12 00:06:04 */
/* http://harviacode.com */
