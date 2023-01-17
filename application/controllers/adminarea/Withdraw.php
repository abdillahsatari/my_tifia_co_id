<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Withdraw extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model('Withdraw_model');
		$this->load->model('Users_pesan_model');
        $this->load->model('Nasabah_model');
		$this->load->model('Log_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}

	public function index()
	{
		$data['title'] = 'Withdraw';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Withdraw' => '',
		];
		$data['code_js'] = 'withdraw/codejs';
		$data['page'] = 'withdraw/withdraw';
		$this->load->view('template/backend', $data);
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Withdraw_model->json();
	}

	public function read($id)
	{
		$row = $this->Withdraw_model->get_by_id_join($id);
		if ($row) {
			$data = array(
				'withdraw_id' => $row->withdraw_id,
				'nasabah_id' => $row->nasabah_id,
				'nama_lengkap' => $row->nama_lengkap,
				'email' => $row->email,

				'no_akun' => $row->no_akun,
				'type' => $row->type,
				'nama_currency' => $row->nama_currency,
				'withdraw_rate' => number_format($row->withdraw_rate),
				'nama_leverage' => $row->nama_leverage,
				'komisi' => $row->komisi,

				'bank_id' => $row->bank_id,
				'nama_bank' => $row->nama_bank,
				'no_rekening' => $row->no_rekening,
				'atas_nama' => $row->atas_nama,
				'currency' => $row->currency,

				'total' => number_format($row->total),
				'status_withdraw' => $row->status_withdraw,
				'tanggal_withdraw' => $row->tanggal_withdraw,
				'komentar' => $row->komentar,
			);
			$data['title'] = 'Withdraw';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			$data['page'] = 'withdraw/withdraw_read';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('withdraw'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('adminarea/withdraw/create_action'),
			'withdraw_id' => set_value('withdraw_id'),
			'nasabah_id' => set_value('nasabah_id'),
			'no_akun' => set_value('no_akun'),
			'wallet_id' => set_value('wallet_id'),
			'bank_id' => set_value('bank_id'),
			'total' => set_value('total'),
			'status_withdraw' => set_value('status_withdraw'),
			'sumber_withdraw' => set_value('sumber_withdraw'),
			'tanggal_withdraw' => set_value('tanggal_withdraw'),
			'kode_withdraw' => set_value('kode_withdraw'),
		);
		$data['title'] = 'Withdraw';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Dashboard' => '',
		];

		$data['page'] = 'withdraw/withdraw_form';
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
				'no_akun' => $this->input->post('no_akun', TRUE),
				'wallet_id' => $this->input->post('wallet_id', TRUE),
				'bank_id' => $this->input->post('bank_id', TRUE),
				'total' => $this->input->post('total', TRUE),
				'status_withdraw' => $this->input->post('status_withdraw', TRUE),
				'sumber_withdraw' => $this->input->post('sumber_withdraw', TRUE),
				'tanggal_withdraw' => $this->input->post('tanggal_withdraw', TRUE),
				'kode_withdraw' => $this->input->post('kode_withdraw', TRUE),
			);
		}
		$this->Withdraw_model->insert($data);
		$this->session->set_flashdata('message', 'Create Record Success');
		redirect(site_url('adminarea/withdraw'));
	}

	public function update($id)
	{
		$row = $this->Withdraw_model->get_by_id_join($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('adminarea/withdraw/update_action'),
				'withdraw_id' => set_value('withdraw_id', $row->withdraw_id),
				'nasabah_id' => set_value('nasabah_id', $row->nasabah_id),
				'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
				'email' => set_value('email', $row->email),

				'no_akun' => set_value('no_akun', $row->no_akun),
				'type' => set_value('type', $row->type),
				'nama_currency' => set_value('nama_currency', $row->nama_currency),
				'withdraw_rate' => set_value('withdraw_rate', number_format($row->withdraw_rate)),
				'nama_leverage' => set_value('nama_leverage', $row->nama_leverage),
				'komisi' => set_value('no_akun', $row->komisi),

				'bank_id' => set_value('bank_id', $row->bank_id),
				'nama_bank' => set_value('nama_bank', $row->nama_bank),
				'no_rekening' => set_value('no_rekening', $row->no_rekening),
				'atas_nama' => set_value('atas_nama', $row->atas_nama),
				'currency' => set_value('currency', $row->currency),

				'total' => set_value('total', $row->total),
				'status_withdraw' => set_value('status_withdraw', $row->status_withdraw),
				'komentar' => set_value('komentar', $row->komentar),
			);
			$data['title'] = 'Withdraw';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			$data['page'] = 'withdraw/withdraw_form';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/withdraw'));
		}
	}

	public function update_action()
	{
		$user = $this->ion_auth->user()->row();
		// $this->_rules();
		$this->form_validation->set_rules('status_withdraw', 'status withdraw', 'trim|required');
		if ($this->input->post('status_withdraw', TRUE) == 'Reject') {
			$this->form_validation->set_rules('komentar', 'komentar', 'trim|required');
		}

        $nasabah    = $this->Nasabah_model->get_by_id($this->input->post("nasabah_id"));
        $no_akun    = $this->input->post('no_akun', TRUE);
        $total      = $this->input->post("total");
        $wdRate     = filter_var($this->input->post("wd_rate"), FILTER_SANITIZE_NUMBER_INT);
        $wdAmmount  = $total / $wdRate;

        $endpoint   = $this->endpoints->sogeeapi_real(Accounts::GET_SINGLE_RECORD, $no_akun);
        $rest       = $this->restclient->requestGet($endpoint);
        $currentBalance = json_decode($rest["response"], true)["balance"];
        $wdResult   = $currentBalance - $wdAmmount;

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('withdraw_id', TRUE));
		} elseif ($wdResult < 0 && $this->input->post('status_withdraw', TRUE) == "Done"){

            //validate account balance in meta
            $this->session->set_flashdata('message', 'Update Record Failed. The Selected Account dont have enough balance');
            redirect(site_url('adminarea/withdraw'));

        } else {

            if ($wdResult <= 0){

                /**
                 *
                 * Decrease Balance to selected Meta Account
                 *
                 **/

                $body       = array("value"     => -$wdAmmount, "comment"   => "Withdraw");
                $endpoint   = $this->endpoints->sogeeapi_real(Accounts::POST_WITHDRAWAL, $no_akun);
                $this->restclient->requestPost($endpoint, $body);
            }

            /**
             *
             * Update Balance Ammount into Kabinet
             *
             **/

//           Start database transaction
            $this->db->trans_start();

            //1. update data wd
            $data   = array('status_withdraw'       => $this->input->post('status_withdraw', TRUE),
                            'total'                 => $this->input->post('total', TRUE),
                            'komentar'              => $this->input->post('komentar', TRUE),
                            'tanggal_konfirmasi'    => new_date(),
                            'no_akun'               => $no_akun);

            $this->Withdraw_model->update($this->input->post('withdraw_id', TRUE), $data);

            $statusWd = $this->input->post('status_withdraw', TRUE) == "Done" ? "Approve" : $this->input->post('status_withdraw', TRUE);

            //3. masukan email ke tabel users log
            // $dataEmail = array(
            // 	'nasabah_id' => $this->input->post('nasabah_id', TRUE),
            // 	'subject' => $subject,
            // 	'isi' => $isi,
            // 	'user_id' => $user->id
            // );
            // $this->Users_pesan_model->insert($dataEmail);
            //4. masukan ke log user
            $dataLog    = array('user_id'       => $user->id,
                                'nasabah_id'    => $this->input->post('nasabah_id', TRUE),
                                'withdraw_id'   => $this->input->post('withdraw_id', TRUE),
                                'type'          => 'Withdraw',
                                'read_status'   => 'Y',
                                'aktifitas'     => 'Approval Withdraw');
            $this->Log_model->insert_admin($dataLog);

            //5. lempar ke halaman wd

            // End transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('message', 'Update Record Failed');
            } else {

                // Load helper email dan konfigurasinya
                //2. kirim email ke nasabah
                $subject    = "Withdraw " . $this->input->post('status_withdraw', TRUE);
                $isi_email  = ['nasabah_id' => $this->input->post('nasabah_id', TRUE),
                    'nama'      => $nasabah->nama_lengkap,
                    'judul'     => $subject,
                    'pesan'     => 'Withdraw anda dengan nomor [' .  $this->input->post('withdraw_id', TRUE)  . '] telah di [' .$statusWd .'] oleh admin',
                    'data'      => $data];

                $this->load->helper('send_email_helper');
                $data_email['email'] = $this->input->post('email', TRUE);
                $data_email['subjek'] = $subject;
                $data_email['pesan'] = $this->load->view('template_email/email_withdraw', $isi_email, true);
                send_mailer($data_email);

                $this->session->set_flashdata('message', 'Update Record Success');
            }

            redirect(site_url('adminarea/withdraw'));
		}
	}

	public function delete($id)
	{
		$row = $this->Withdraw_model->get_by_id($id);

		if ($row) {
			$this->Withdraw_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('adminarea/withdraw'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/withdraw'));
		}
	}

	public function deletebulk()
	{
		$delete = $this->Withdraw_model->deletebulk();
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
		// $this->form_validation->set_rules('no_akun', 'no akun', 'trim|required');
		// $this->form_validation->set_rules('wallet_id', 'wallet id', 'trim|required');
		// $this->form_validation->set_rules('bank_id', 'bank id', 'trim|required');
		// $this->form_validation->set_rules('total', 'total', 'trim|required');
		$this->form_validation->set_rules('status_withdraw', 'status withdraw', 'trim|required');
		// $this->form_validation->set_rules('sumber_withdraw', 'sumber withdraw', 'trim|required');
		// $this->form_validation->set_rules('tanggal_withdraw', 'tanggal withdraw', 'trim|required');
		// $this->form_validation->set_rules('kode_withdraw', 'kode withdraw', 'trim|required');

		$this->form_validation->set_rules('withdraw_id', 'withdraw_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel($status)
	{
		$this->load->helper('exportexcel');
		$namaFile = "withdraw_$status.xls";
		$judul = "withdraw";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Total withdraw");
		xlsWriteLabel($tablehead, $kolomhead++, "Bank");
		xlsWriteLabel($tablehead, $kolomhead++, "Nomor Rekening");
		xlsWriteLabel($tablehead, $kolomhead++, "Status Withdraw");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Withdraw");
		xlsWriteLabel($tablehead, $kolomhead++, "tanggal konfirmasi");

		foreach ($this->Withdraw_model->get_all_join_bystatus($status) as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_akun);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
			xlsWriteNumber($tablebody, $kolombody++, $data->total);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_bank);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_rekening);
			xlsWriteLabel($tablebody, $kolombody++, $data->status_withdraw);
			xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_withdraw);
			xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_konfirmasi);

			$tablebody++;
			$nourut++;
		}

		xlsEOF();
		exit();
	
		
	}

	public function word()
	{
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=withdraw.doc");

		$data = array(
			'withdraw_data' => $this->Withdraw_model->get_all_join(),
			'start' => 0
		);

		$this->load->view('withdraw/withdraw_doc', $data);
	}

	public function printdoc()
	{
		$data = array(
			'withdraw_data' => $this->Withdraw_model->get_all_join(),
			'start' => 0
		);
		$this->load->view('withdraw/withdraw_print', $data);
	}
}

/* End of file Withdraw.php */
/* Location: ./application/controllers/Withdraw.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-14 22:17:37 */
/* http://harviacode.com */
