<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Withdrawal_request extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model(['sales/Withdrawal_request_model' => 'model']);
	}

	public function index()
	{
		$data['title'] = 'Withdrawal';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Withdrawal' => '#',
			'Request' => '#',
		];
		$data['page'] = 'admin_marketing/withdrawal/list_request';
		$this->load->view('template/backend', $data);
	}

	function modal_wd($id)
	{
		$query = $this->db->query("SELECT marketing_withdrawal.*, marketing.nama, marketing.kode as kode_sales, marketing.email, marketing.no_hp FROM marketing_withdrawal, marketing WHERE marketing_withdrawal.id='$id'");


		if ($query->num_rows() > 0) {
			$data = $query->row_array();

			$output = '
			<form action="' . base_url() . 'adminarea/marketing/withdrawal_request/withdrawal_action" method="POST" id="form">

				<input type="hidden" name="id" value="' . $id . '">

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
					
					';

			if ($data['status'] == 'New' || $data['status'] == 'Pending') {
				$output .= '   
					<tr>
						<td>Bank</td>
						<td>
							<input type="text" class="form-control input-sm" name="rekening_bank" value="' . $data['rekening_bank'] . '" id="rekening_bank">
						</td>
					</tr>
					<tr>
						<td>Nama pemilik rekening</td>
						<td>
							<input type="text" class="form-control input-sm" name="rekening_nama" value="' . $data['rekening_nama'] . '" id="rekening_nama">
						</td>
					</tr>
					<tr>
						<td>Nomor rekening</td>
						<td>
							<input type="text" class="form-control input-sm" name="rekening_nomor" value="' . $data['rekening_nomor'] . '" id="rekening_nomor">
						</td>
					</tr>     
					<tr>
						<td colspan="2"><strong>Allowance Info</strong></td>
					</tr>
					<tr>
						<td>Kode</td>
						<td class="text-danger"><strong>' . $data['kode'] . '</strong></td>
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
						<td>Amount requested</td>
						<td>IDR ' . rupiah($data['amount_kotor']) . '</td>
					</tr>
					<tr>
						<td>Amount to transfer (after PPh21)</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">IDR</span>
								<input type="number" class="form-control input-sm" name="amount_bersih" min="0" step="100" value="' .  after_pph21($data['amount_kotor']) . '" id="amount_bersih">
							</div>
						</td>
					</tr>
					<tr>
						<td class="font-weight-bold">Status</td>
						<td>
							<select name="status" id="status" class="form-control">
								<option value="New" disabled>New</option>
								<option value="Pending"' . ($data['status'] == 'Pending' ? 'selected' : '') . '>Pending</option>
								<option value="Approved">Approved</option>
								<option value="Declined">Declined</option>
							</select>
						</td>
					</tr>
				</table>

				<div class="form-group text-center mt-5">
					<button class="btn btn-success" type="submit" id="submit">Kirim</button>
				</div>';
			} else {
				$output .= ' 
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
						<td colspan="2"><strong>Allowance Info</strong></td>
					</tr>
					<tr>
						<td>Kode</td>
						<td class="text-danger"><strong>' . $data['kode'] . '</strong></td>
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
						<td>Date updated</td>
						<td>' . date_tampil($data['date_updated']) . '</td>
					</tr>
					<tr>
						<td>Amount</td>
						<td>IDR ' . ($data['amount_bersih'] == NULL ? rupiah($data['amount_kotor']) : rupiah($data['amount_bersih']))  . '</td>
					</tr>
				</table>';
			}

			$output .= '</form>';
		} else {
			$output = 'Not found';
		}


		echo $output;
	}

	public function withdrawal_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			$this->form_validation->set_rules('id', 'id', 'trim|numeric|required');
			$this->form_validation->set_rules('amount_bersih', 'amount', 'trim|required|numeric|greater_than[0]');
			$this->form_validation->set_rules('status', 'status', 'trim|required|in_list[New,Pending,Approved,Declined]');
			$this->form_validation->set_rules('rekening_bank', 'bank', 'trim|xss_clean');
			$this->form_validation->set_rules('rekening_nama', 'nama pemilik rekening', 'trim|xss_clean');
			$this->form_validation->set_rules('rekening_nomor', 'nomor rekening', 'trim|xss_clean');

			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();
				$id = $this->input->post('id');
				$status = $this->input->post('status');
				$amount = $this->input->post('amount_bersih');

				// Start database transaction
				$this->db->trans_start();

				$query = $this->db->query("SELECT * FROM marketing_withdrawal WHERE id='$id'")->row_array();

				if ($query) {

					$data = [
						'amount_bersih' => $amount,
						'rekening_bank' => $this->input->post('rekening_bank'),
						'rekening_nama' => $this->input->post('rekening_nama'),
						'rekening_nomor' => $this->input->post('rekening_nomor'),
						'status' => $status,
						'parent_id' => NULL,
						'admin_id' => $this->session->userdata('user_id'),
						'date_updated' => $date,
					];
					$this->db->update('marketing_withdrawal', $data, ['id' => $id]);


					$mkt_id = $query['marketing_id'];
					$mkt =  $this->db->query("SELECT nama, email FROM marketing WHERE id='$mkt_id'")->row_array();

					if ($status == 'Approved' || $status == 'Declined') {

						$isi_email = [
							'kode' => $query['kode'],
							'nama' => $mkt['nama'],
							'judul' => 'Withdraw ' . $status,
							'pesan' => 'Withdrawal anda dengan kode [' . $query['kode'] . '] ' . ($status == 'Approved' ? 'telah disetujui, sebagai berikut' : 'ditolak'),
							'data' => $data,
						];

						$this->load->helper('send_email_helper');
						$data_email['email'] = $mkt['email'];
						$data_email['pesan'] = $this->load->view('template_email/email_mkt_wd', $isi_email, true);
						$data_email['subjek'] = 'Withdrawal Request ' . $status;
						send_mailer($data_email);
					}
				}

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Update withdrawal gagal';
				} else {
					$json['success'] = true;
					$json['alert'] = 'Update withdrawal berhasil';
					$json['href'] = base_url('adminarea/marketing/allowance_terbayar');
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "withdrawal request.xls";
		$judul = "withdrawal request";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Withdraw");
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Marketing");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Marketing");
		xlsWriteLabel($tablehead, $kolomhead++, "Amount Request");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Request");
		xlsWriteLabel($tablehead, $kolomhead++, "Status");

		foreach ($this->model->get_all() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode_sales);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama);
			xlsWriteNumber($tablebody, $kolombody++, $data->amount_kotor);
			xlsWriteLabel($tablebody, $kolombody++, $data->date_requested);
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
			$sub_array[] =  '<div class="text-center"><button class="btn btn-sm btn-success modalView" data-href="' . base_url('adminarea/marketing/Withdrawal_request/modal_wd/' . $r->id) . '">Proses <i class="fa fa-arrow-right"></i></button></div>';
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
