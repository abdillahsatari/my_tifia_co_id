<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Withdrawlist extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model('Withdraw_model');
		$this->load->model('Users_pesan_model');
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
		$data['code_js'] = 'withdraw/codejslist';
		$data['page'] = 'withdraw/withdraw_list';
		$this->load->view('template/backend', $data);
	}

	public function json() {
		header('Content-Type: application/json');
		echo $this->Withdraw_model->jsonList();
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

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "withdraw.xls";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Nasabah");
		xlsWriteLabel($tablehead, $kolomhead++, "Email Nasabah");

		xlsWriteLabel($tablehead, $kolomhead++, "No Akun");
		xlsWriteLabel($tablehead, $kolomhead++, "Total");
		xlsWriteLabel($tablehead, $kolomhead++, "Status Withdraw");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Withdraw");

		foreach ($this->Withdraw_model->get_all_join() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
			xlsWriteLabel($tablebody, $kolombody++, $data->email);
			xlsWriteNumber($tablebody, $kolombody++, number_format($data->total));
			xlsWriteLabel($tablebody, $kolombody++, $data->status_withdraw);
			xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_withdraw);

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

		$this->load->view('withdraw/withdraw_doc',$data);
	}

	public function printdoc(){
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
