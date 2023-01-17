<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Transferbalance extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model('Deposit_model');
        $this->load->model('Nasabah_model');
		$this->load->model('Acc_trading_model');
		$this->load->model('Users_pesan_model');
		$this->load->model('Log_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}

	public function index()
	{
		$data['title'] = 'Transfer balance';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Deposit' => '',
		];
		$data['code_js'] = 'transferBalance/codejs';
		$data['page'] = 'transferBalance/transferBalance_list';
		$this->load->view('template/backend', $data);
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Deposit_model->jsonTrasferBalance();
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
			$data['title'] = 'Tranfer balance';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			$data['page'] = 'transferBalance/transferBalance_read';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('transferBalance'));
		}
	}
	public function update($id)
	{
		$row = $this->Deposit_model->get_by_id_join($id);

		if ($row) {
			$data = array(
				'button' => 'Transfer Balance',
				'action' => site_url('adminarea/transferbalance/update_action'),

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
				'type_deposit' => set_value('type_deposit', $row->type_deposit),
				'status_deposit' => set_value('status_deposit', $row->status_deposit),
				'tanggal_deposit' => set_value('tanggal_deposit', $row->tanggal_deposit),
			);
			$data['title'] = 'Deposit';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			$data['page'] = 'transferBalance/transferBalance_form';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/transferbalance'));
		}
	}

	public function update_action()
	{

        // $this->_rules();
        $user = $this->ion_auth->user()->row();

        /**
         *
         * Add Balance to selected Account Meta
         *
         **/

        $accountNumber  = $this->input->post('no_akun', TRUE);
        $body           = array("value"     => $this->input->post('balance', TRUE),
                                "comment"   => "Deposit");

        $endpoint = $this->endpoints->sogeeapi_real(Accounts::POST_DEPOSIT, $accountNumber);
        $restPD = $this->restclient->requestPost($endpoint, $body);

        if ($restPD["code"] == 201){

            /**
             *
             * Update Balance Ammount in Kabinet
             *
             **/

            //1. update data deposit
            // tambahkan balance
            $nasabah            = $this->Nasabah_model->get_by_id($this->input->post("nasabah_id"));
            $is_balance         =  $this->Acc_trading_model->get_by_id($this->input->post('no_akun', TRUE));
            $total_balance      = $this->input->post('balance', TRUE);
            $total              = bcadd($is_balance->balance, $total_balance, 2);
            $data               = array('status_deposit'        => "Sukses",
                                        'total_balance'         => $total_balance,
                                        'tanggal_konfirmasi'    => new_date());

            $dataBalance        = array('balance'               => $total);

            $this->Deposit_model->updateStatus($this->input->post('deposit_id', TRUE), $data);
            $this->Acc_trading_model->update($this->input->post('no_akun', TRUE), $dataBalance);

            //2. kirim email ke nasabah
            $subject = "Deposit " . $this->input->post('status_deposit', TRUE);
            // $isi = "Deposit anda dengan nomor " . $this->input->post('deposit_id', TRUE) . " telah di " . $this->input->post('status_deposit', TRUE) . " oleh admin.";

            //3. input ke user pesan
            // $dataEmail = array(
            // 	'nasabah_id' => $this->input->post('nasabah_id', TRUE),
            // 	'subject' => $subject,
            // 	'isi' => $isi,
            // 	'user_id' => $user->id
            // );

            // $this->Users_pesan_model->insert($dataEmail);
            //4. masukkan ke log user
            $dataLog    = array('user_id'       => $user->id,
                                'nasabah_id'    => $this->input->post('nasabah_id', TRUE),
                                'deposit_id'    => $this->input->post('deposit_id', TRUE),
                                'type'          => 'Deposit',
                                'read_status'   => 'N',
                                'aktifitas'     => 'Approval Deposit');
            $this->Log_model->insert_admin($dataLog);
            //5. lempar ke halaman transferBalance

            // End transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('message', 'Update Record Failed');
            } else {
                // Load helper email dan konfigurasinya
                $isi_email  = ['kode'   =>  $this->input->post('deposit_id', TRUE),
                                'nama'  => $nasabah->nama_lengkap,
                                'judul' => 'Deposit ' . $this->input->post('status_deposit', TRUE),
                                'pesan' => 'Setoran anda dengan kode [' .  $this->input->post('deposit_id', TRUE)  . '] Telah dikonfirmasi Admin',
                                'data'  => $data];

                $this->load->helper('send_email_helper');
                $data_email['email'] = $this->input->post('email', TRUE);
                $data_email['subjek'] = $subject;
                $data_email['pesan'] = $this->load->view('template_email/email_trasferbalance', $isi_email, true);
                send_mailer($data_email);
                $this->session->set_flashdata('message', 'Update Record Success');
            }
        } else {
            $this->session->set_flashdata('message', 'Update Record Failed');
        }

        redirect(site_url('adminarea/transferBalance'));
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
