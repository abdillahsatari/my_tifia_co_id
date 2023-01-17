<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Acc_demo_request extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model(['Acc_demo_request_model' => 'model', 'Acc_demo_model', 'Acc_request_model']);
	}

	public function index()
	{
		$data['title'] = 'Account Demo';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Account Trading' => '#',
			'Request Akun Demo' => '#',
		];
		$data['page'] = 'acc_demo_request/acc_demo_request_list';
		$this->load->view('template/backend', $data);
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
				'deposit' => set_value('deposit', $row->deposit),

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

			$data['page'] = 'acc_demo_request/acc_demo_request_form';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/acc_request'));
		}
	}


	public function read($id)
	{
		$row = $this->model->get_by_id_join($id);
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
				'date' => $row->date_request,
				'status_request' => $row->status_request,
			);

			$output = '
				<table class="table">
            	    <!-- <tr><td>Nasabah Id</td><td>' . $data['nasabah_id'] . '</td></tr>
            	    <tr><td>Acc Currency Id</td><td>' . $data['acc_currency_id'] . '</td></tr>
            	    <tr><td>Acc Type Id</td><td>' . $data['acc_type_id'] . '</td></tr>
            	    <tr><td>Acc Leverage Id</td><td>' . $data['acc_leverage_id'] . '</td></tr> -->
                    <tr><td>Nama</td><td>' . $data['nama_lengkap'] . '</td></tr>
                    <tr><td>Email</td><td>' . $data['email'] . '</td></tr>
                    <tr><td>Tipe Akun</td><td>' . $data['type'] . '</td></tr>
                    <tr><td>Nilai Tukar</td><td>' . $data['currency'] . '</td></tr>
                    <tr><td>leverage</td><td>' . $data['leverage'] . '</td></tr>
            	    <tr><td>Tanggal Request</td><td>' . date_tampil($data['date']) . '</td></tr>
            	    <tr><td>Status Request</td><td>' . $data['status_request'] . '</td></tr>
            	</table>
			
			';
			echo $output;
		}
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "acc_demo_request.xls";
		$judul = "acc_demo_request";
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

		foreach ($this->model->get_all() as $data) {
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
		header("Content-Disposition: attachment;Filename=acc_demo_request.doc");

		$data = array(
			'acc_request_data' => $this->Acc_request_model->get_all(),
			'start' => 0
		);

		$this->load->view('acc_demo_request/acc_demo_request_doc', $data);
	}

	public function printdoc()
	{
		$data = array(
			'acc_request_data' => $this->Acc_request_model->get_all(),
			'start' => 0
		);
		$this->load->view('acc_demo_request/acc_demo_request_print', $data);
	}

	// ################################################
	// datatables
	function fetch_list()
	{
		$fetch_data = $this->model->make_datatables_list();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			$sub_array = array();
			$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->nama_lengkap . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->email . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->type . '</div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->tanggal_request) . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->status_request . '</div>';
			$sub_array[] =  '<div class="text-center">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button class="btn btn-xs btn-primary modalView" data-href="' . base_url('adminarea/acc_demo_request/read/' . $r->acc_request_id) . '"><i class="fa fa-search"></i></button>
				<a class="btn btn-xs btn-warning" href="' . base_url('adminarea/acc_demo_request/update/' . $r->acc_request_id) . '"><i class="fa fa-edit"></i></a>
			</div>';
			$data[] = $sub_array;
			$no++;
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->model->get_all_data_list(),
			"recordsFiltered" => $this->model->get_filtered_data_list(),
			"data" => $data
		);
		echo json_encode($output);
	}
}
