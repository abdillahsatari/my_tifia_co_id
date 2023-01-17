<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Allowance_request extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole('8');
		agreement_check();
		$this->load->model(['Allowance_request_model' => 'model']);
	}

	public function index()
	{
		$main['mkt'] = $this->model->select_marketing();
		$this->viewku->title("Allowance Request");
		$this->viewku->view("allowance/list_request.php", $main);
	}

	public function requestIndividual_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			$this->form_validation->set_rules('marketing_id', 'marketing', 'trim|numeric|required');
			$this->form_validation->set_rules('allowance', 'allowance', 'trim|required|numeric|greater_than[0]');

			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();
				$marketing_id = $this->input->post('marketing_id');
				$allowance = $this->input->post('allowance');

				// Start database transaction
				$this->db->trans_start();

				// $cek = $this->db->query("SELECT * FROM marketing_allowance WHERE marketing_id='$marketing_id' AND (status='New' OR status='Pending')")->num_rows();

				$mkt = $this->db->query("SELECT * FROM marketing WHERE id='$marketing_id'")->row_array();

				$data = [
					'kode' => '0',
					'marketing_id' => $marketing_id,
					'amount_kotor' => $allowance,
					'amount_bersih' => NULL,
					'rekening_nama' => $mkt['rekening_nama'],
					'rekening_bank' => $mkt['rekening_bank'],
					'rekening_nomor' => $mkt['rekening_nomor'],
					'date_requested' => $date,
					'request_marketing_id' => sess('mkt'),
					'status' => 'New'
				];
				$this->db->insert('marketing_allowance', $data);
				$id = $this->db->insert_id();

				$kode = 'ALW-' . generate_kd(10, $id);
				$this->db->update('marketing_allowance', ['kode' => $kode], ['id' => $id]);

				// insert log
				$marketing_log = [
					'marketing_id' => sess('mkt'),
					'summary' => 'marketing_allowance[' . $id . ']',
					'tipe' => 'tambah allowance request',
					'aktifitas' => 'Request allowance ' . $kode,
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Request individual gagal';
				} else {
					// send whatsapp
					$this->Rapiwha->send_fromAdmin('Notifikasi: Mitra dengan akun ' . $this->session->userdata('mkt_email') . ' melakukan request allowance. Mohon untuk segera melakukan approval.', 3);

					// send email ke admin
					$this->load->helper('send_email_helper');
					$email['email'] = 'romy@tfx.co.id';
					$email['subjek'] = 'Mitra request allowance';
					$email['pesan'] = 'Dear admin, Mitra dengan akun ' . $this->session->userdata('mkt_email') . ' melakukan request allowance. Mohon untuk segera melakukan approval.';
					send_mailer($email);

					$json['success'] = true;
					$json['alert'] = 'Request individual berhasil';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	public function requestAll_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['success' => false, 'alert' => array()];

			$date = new_date();

			// Start database transaction
			$this->db->trans_start();

			$mkt = $this->model->marketing_custom_revenue();

			$summary_id = [];

			foreach ($mkt as $r) {

				$data = [
					'marketing_id' => $r->marketing_id,
					'amount_kotor' => $r->allowance,
					'amount_bersih' => NULL,
					'rekening_nama' => $r->rekening_nama,
					'rekening_bank' => $r->rekening_bank,
					'rekening_nomor' => $r->rekening_nomor,
					'date_requested' => $date,
					'request_marketing_id' => sess('mkt'),
					'status' => 'New'
				];
				$this->db->insert('marketing_allowance', $data);
				$id = $this->db->insert_id();

				$kode = 'ALW-' . generate_kd(10, $id);
				$this->db->update('marketing_allowance', ['kode' => $kode], ['id' => $id]);

				array_push($summary_id, $id);
			}

			// insert log
			$marketing_log = [
				'marketing_id' => sess('mkt'),
				'summary' => 'marketing_allowance[' . implode("|", $summary_id) . ']',
				'tipe' => 'tambah allowance request multiple',
				'aktifitas' => 'Request allowance multiple',
				'date' => $date
			];
			$this->db->insert('marketing_log', $marketing_log);

			// End transaction
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				$json['alert'] = 'Request all gagal';
			} else {
				// send whatsapp
				$this->Rapiwha->send_fromAdmin('Notifikasi: Mitra melakukan request allowance. Mohon untuk segera melakukan approval.', 3);

				// send email ke admin
				$this->load->helper('send_email_helper');
				$email['email'] = 'romy@tfx.co.id';
				$email['subjek'] = 'Mitra request allowance';
				$email['pesan'] = 'Dear admin, Mitra melakukan request allowance. Mohon untuk segera melakukan approval.';
				send_mailer($email);

				$json['success'] = true;
				$json['alert'] = 'Request all berhasil';
			}

			echo json_encode($json);
		}
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
			$sub_array[] =  '<div class="text-center font-weight-bold">' . $r->kode . '</div>';
			$sub_array[] =  '<div class="text-left font-weight-bold">
								<span class="text-danger">' . $r->kode_sales . '</span>
								<br>
								' . $r->nama . '
								</div>';
			$sub_array[] =  '<div class="text-center">IDR ' . rupiah($r->amount_kotor) . '</div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->date_requested) . '</div>';
			$sub_array[] =  '<div class="text-center"><code>' . $r->status . '</code></div>';
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
