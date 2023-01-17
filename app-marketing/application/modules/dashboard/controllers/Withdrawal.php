<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Withdrawal extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole('3');
		agreement_check();
		$this->load->model(['Withdrawal_model' => 'model']);
	}

	public function index()
	{
		$this->viewku->title("Withdrawal");
		$this->viewku->view("withdrawal/list");
	}

	public function tambah()
	{
		$marketing_id = sess('mkt');

		$main['mkt'] = $this->db->query('SELECT rekening_nama, rekening_bank, rekening_nomor FROM marketing WHERE id=' . $marketing_id)->row_array();

		$this->viewku->title("Withdraw");
		$this->viewku->view("withdrawal/tambah", $main);
	}

	public function tambah_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			$this->form_validation->set_rules('amount', 'amount', 'trim|required|numeric|greater_than_equal_to[500000]');
			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();

				$marketing_id = sess('mkt');

				// cek apakah balance >= amount withdraw
				if (mkt_total_balance($marketing_id) >= $this->input->post('amount')) {

					$mkt = $this->db->query('SELECT rekening_nama, rekening_bank, rekening_nomor, status_perjanjian FROM marketing WHERE id=' . $marketing_id)->row_array();

					// cek apakah sudah mengisi perjanjian
					if ($mkt['status_perjanjian'] == 'Approved') {

						// Start database transaction
						$this->db->trans_start();

						// insert marketing_withdrawal
						$marketing_withdrawal = [
							'kode' => '0',
							'marketing_id' => $marketing_id,
							'amount_input' => $this->input->post('amount'),
							'amount_kotor' => $this->input->post('amount'),
							'rekening_nama' => $mkt['rekening_nama'],
							'rekening_bank' => $mkt['rekening_bank'],
							'rekening_nomor' => $mkt['rekening_nomor'],
							'date_requested' => $date,
							'status' => 'New'
						];
						$this->db->insert('marketing_withdrawal', $marketing_withdrawal);
						$id = $this->db->insert_id();

						$kode = 'WD-' . generate_kd(10, $id);
						$this->db->update('marketing_withdrawal', ['kode' => $kode], ['id' => $id]);

						// insert log
						$marketing_log = [
							'marketing_id' => $marketing_id,
							'summary' => "marketing_withdrawal[$id]",
							'tipe' => 'request withdrawal',
							'aktifitas' => 'Melakukan request withdrawal [' . $kode . ']',
							'date' => $date
						];
						$this->db->insert('marketing_log', $marketing_log);

						// End transaction
						$this->db->trans_complete();

						if ($this->db->trans_status() === FALSE) {
							$json['alert'] = 'Request withdrawal gagal';
						} else {

							// send whatsapp
							$this->Rapiwha->send_fromAdmin('Notifikasi: Mitra dengan akun ' . $this->session->userdata('mkt_email') . ' melakukan withdrawal. Mohon untuk segera melakukan approval.', 6);

							// // kirim email pemberitahuan ke Admin
							// $this->load->helper('send_email_helper');
							// $data_email['email'] = 'settlement@tfx.co.id';
							// $data_email['subjek'] = 'Permintaan buka akun demo';
							// $data_email['pesan'] = 'Dear admin, Mitra dengan akun ' . $this->session->userdata('mkt_email') . ' melakukan withdrawal. Mohon untuk segera melakukan approval.';

							$json['success'] = true;
							$json['alert'] = 'Request withdrawal berhasil';
							$json['href'] = base_url() . 'dashboard/withdrawal';
						}
					} else
						$json['alert'] = 'Mohon untuk menyelesaikan Nota Kesepakatan Kerjasama Kegiatan Pemasaran.';
				} else {
					$json['alert'] = 'Balance insufficent';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	function modal_wd($id)
	{
		$query = $this->db->query("SELECT marketing_withdrawal.*, marketing.nama, marketing.kode as kode_sales, marketing.email, marketing.no_hp FROM marketing_withdrawal, marketing WHERE marketing_withdrawal.id='$id'");

		if ($query->num_rows() > 0) {
			$data = $query->row_array();
			$output = '
                    <table class="table table-striped">
                        <tr>
                            <td colspan="2" class="font-weight-bold">Bank Info</td>
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
                            <td colspan="2" class="font-weight-bold">Withdrawal Info</td>
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
                            <td>Date updated</td>
                            <td>' . date_tampil($data['date_updated']) . '</td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td>IDR ' . ($data['amount_bersih'] == NULL ? rupiah($data['amount_kotor']) : rupiah($data['amount_bersih']))  . '</td>
                        </tr>
                    </table>';
		} else {
			$output = 'Not found';
		}


		echo $output;
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
			$sub_array[] =  '<div class="text-center">IDR ' . ($r->amount_bersih > 0 ? rupiah($r->amount_bersih) : rupiah($r->amount_kotor)) . '</div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->date_requested) . '</div>';
			$sub_array[] =  '<div class="text-center"><code>' . $r->status . '</code></div>';
			$sub_array[] =  '<div class="text-center"><button class="btn btn-sm btn-primary modalView" data-href="' . base_url('dashboard/withdrawal/modal_wd/' . $r->id) . '"><i class="fa fa-info-circle"></i></button></div>';
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
