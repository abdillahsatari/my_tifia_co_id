<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Withdrawal_terbayar extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model(['sales/Withdrawal_terbayar_model' => 'model']);
	}

	public function index()
	{
		$data['title'] = 'Withdrawal';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Withdrawal' => '#',
			'Approved' => '#',
		];
		$data['page'] = 'admin_marketing/withdrawal/list_approved';
		$this->load->view('template/backend', $data);
	}

	function modal_wd($id)
	{
		$query = $this->db->query("SELECT marketing_withdrawal.*, marketing.nama, marketing.kode as kode_sales, marketing.email, marketing.no_hp FROM marketing_withdrawal, marketing WHERE marketing_withdrawal.id='$id'");

		if ($query->num_rows() > 0) {
			$data = $query->row_array();
			$output = '
                    <table class="table table-striped">
						<tr>
							<td colspan="2"><strong>Marketing Info</strong></td>
						</tr>
						<tr>
							<td>Marketing</td>
							<td>
							<b class="text-danger">' . $data['kode_sales'] . '</b><br>
							' . $data['nama'] . '
							</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>' . $data['email'] . '</td>
						</tr>
						<tr>
							<td>No. HP</td>
							<td>' . $data['no_hp'] . '</td>
						</tr>
                        <tr>
                            <td colspan="2"><strong>Bank Info</strong></td>
                        </tr>
                        <tr>
                            <td>Bank</td>
                            <td>' . $data['rekening_bank'] . '</td>
                        </tr>
                        <tr>
                            <td>Nama pemilik rekening</td>
                            <td>' . $data['rekening_nama'] . '</td>
                        </tr>
                        <tr>
                            <td>Nomor rekening</td>
                            <td>' . $data['rekening_nomor'] . '</td>
                        </tr>          
                        <tr>
                            <td colspan="2"><strong>Withdrawal Info</strong></td>
                        </tr>
                        <tr>
                            <td>Kode</td>
                            <td class="text-danger">' . $data['kode'] . '</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><code>' . $data['status'] . '</code></td>
                        </tr>
                        <tr>
                            <td>Date requested</td>
                            <td>' . date_tampil($data['date_requested']) . '</td>
                        </tr>
                        <tr>
                            <td>Amount Requested</td>
                            <td>IDR ' . rupiah($data['amount_kotor']) . '</td>
                        </tr>
                        <tr>
                            <td>Date updated</td>
                            <td>' . date_tampil($data['date_updated']) . '</td>
                        </tr>
						<tr>
                            <td>Amount transfer</td>
                            <td>IDR ' . rupiah($data['amount_bersih']) . '</td>
                        </tr>
                    </table>';
		} else {
			$output = 'Not found';
		}


		echo $output;
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "withdrawal approved.xls";
		$judul = "withdrawal approved";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Withdrawal");
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Marketing");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Marketing");
		xlsWriteLabel($tablehead, $kolomhead++, "Amount Request");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Request");
		xlsWriteLabel($tablehead, $kolomhead++, "Amount Transfer");
		xlsWriteLabel($tablehead, $kolomhead++, "Bank");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Pemilik Rekening");
		xlsWriteLabel($tablehead, $kolomhead++, "Nomor Rekening");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Approved");
		xlsWriteLabel($tablehead, $kolomhead++, "Status");

		foreach ($this->model->get_all() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode_sales);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama);
			xlsWriteLabel($tablebody, $kolombody++, $data->amount_kotor);
			xlsWriteLabel($tablebody, $kolombody++, $data->date_requested);
			xlsWriteLabel($tablebody, $kolombody++, $data->amount_bersih);
			xlsWriteLabel($tablebody, $kolombody++, $data->rekening_bank);
			xlsWriteLabel($tablebody, $kolombody++, $data->rekening_nama);
			xlsWriteLabel($tablebody, $kolombody++, $data->rekening_nomor);
			xlsWriteLabel($tablebody, $kolombody++, $data->date_updated);
			xlsWriteLabel($tablebody, $kolombody++, $data->status);

			$tablebody++;
			$nourut++;
		}



		xlsEOF();
		exit();
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
			$sub_array[] =  '<div class="text-danger">
								' . $r->kode . '
								</div>';
			$sub_array[] =  '<div class="text-left">
                                <a href="' . base_url('adminarea/marketing/sales/view/' . $r->marketing_id) . '" class="text-danger">' . $r->kode_sales . '</a>
								<br>
								' . $r->nama . '
								</div>';
			$sub_array[] =  '<div class="text-center">IDR ' . ($r->amount_bersih > 0 ? rupiah($r->amount_bersih) : rupiah($r->amount_kotor)) . '</div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->date_requested) . '</div>';
			$sub_array[] =  '<div class="text-center"><code>' . $r->status . '</code></div>';
			$sub_array[] =  '<div class="text-center"><button class="btn btn-sm btn-primary modalView" data-href="' . base_url('adminarea/marketing/Withdrawal_terbayar/modal_wd/' . $r->id) . '"><i class="fa fa-info-circle"></i></button></div>';
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
