<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole(['7', '8']);
		agreement_check();
		$this->load->library(['tree']);
		$this->load->model(['Setting_model' => 'model']);
	}

	public function index()
	{
		$this->customrevenue();
	}

	public function customrevenue()
	{
		$this->viewku->title("Perhitungan komisi");
		$this->viewku->view("setting/perhitungan_komisi.php");
	}

	public function modal_editAllowance($marketing_id)
	{
		$output = '';

		// $marketing_id = sess('mkt');
		$custom_revenue = $this->db->query("SELECT * FROM marketing_custom_revenue WHERE marketing_id='$marketing_id'");

		$data = $custom_revenue->row_array();

		$output = '
			<form action="' . base_url() . 'dashboard/setting/editAllowance_action/' . $marketing_id . '" method="POST" id="form">

				<p><b>Note : </b> Field yang kosong tidak akan diproses</p>

				<div class="form-group">
					<label class="" for="komisi">Komisi</label>
					<div class="input-group mb-3" id="komisi">
						<input type="number" min="" step="0.01" class="form-control" value="' . ($data['komisi'] != '' ? $data['komisi'] : '') . '" name="komisi">
						<div class="input-group-prepend">
							<span class="input-group-text">%</span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="" for="nmi">NMI</label>
					<div class="input-group mb-3" id="nmi">
						<input type="number" min="" step="0.01" class="form-control" value="' . ($data['nmi'] != '' ? $data['nmi'] : '') . '" name="nmi">
						<div class="input-group-prepend">
							<span class="input-group-text">%</span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="" for="allowance">Allowance</label>
					<div class="input-group mb-3" id="allowance">
						<div class="input-group-prepend">
							<span class="input-group-text">IDR</span>
						</div>
						<input type="number" min="" step="1000" class="form-control" name="allowance" value="' . ($data['allowance'] != '' ? $data['allowance'] : '') . '">
					</div>
				</div>

				<div class="form-group text-center">
					<button type="submit" id="submit" class="btn btn-primary mt-3">Submit</button>
				</div>

			</form>
			
			';


		echo $output;
	}

	public function editAllowance_action($id)
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			$this->form_validation->set_rules('komisi', 'komisi', 'trim|numeric|greater_than_equal_to[0]');
			$this->form_validation->set_rules('nmi', 'nmi', 'trim|numeric|greater_than_equal_to[0]');
			$this->form_validation->set_rules('allowance', 'allowance', 'trim|numeric|greater_than_equal_to[0]');

			$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();

				// Start database transaction
				$this->db->trans_start();

				$data = [
					'komisi' => ($this->input->post('komisi') != '' ? $this->input->post('komisi') : NULL),
					'nmi' => ($this->input->post('nmi') != '' ? $this->input->post('nmi') : NULL),
					'allowance' => ($this->input->post('allowance') != '' ? $this->input->post('allowance') : NULL),
				];

				$query_custom_revenue = $this->db->query("SELECT * FROM marketing_custom_revenue WHERE marketing_id='$id'");
				if ($query_custom_revenue->num_rows() > 0) {
					$revenue = $query_custom_revenue->row_array();

					if ($data['komisi'] == NULL && $data['nmi'] == NULL && $data['allowance'] == NULL) {
						// delete jika komisi, nmi, dan allowance == NULL
						$this->db->delete('marketing_custom_revenue', ['id' => $revenue['id']]);
					} else {
						// update jika sudah ada
						$this->db->update('marketing_custom_revenue', $data, ['id' => $revenue['id']]);
					}
				} else {
					$data['marketing_id'] = $id;
					// insert jika belum ada
					$this->db->insert('marketing_custom_revenue', $data);
				}

				// insert log
				$marketing_log = [
					'marketing_id' => sess('mkt'),
					'summary' => 'marketing_custom_revenue[marketing_id:' . $id . ']',
					'tipe' => 'edit custom revenue',
					'aktifitas' => 'Edit custom revenue',
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Edit revenue gagal';
				} else {
					$json['success'] = true;
					$json['alert'] = 'Edit revenue berhasil';
					// $json['href'] = base_url() . 'dashboard';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	// ################################################
	// datatables
	function fetch_list() // custom revenue
	{
		// get sales yg dapat user lihat
		$array_sales = $this->tree->get_all_child_id(sess('mkt'));

		$fetch_data = $this->model->make_datatables_list();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			// cek apabila termasuk child dari user
			if (in_array($r->id, $array_sales)) {

				$custom_revenue = $this->db->query("SELECT * FROM marketing_custom_revenue WHERE marketing_id='$r->id'")->row_array();
				$default_revenue = $this->db->query("SELECT komisi FROM marketing_setting_revenue WHERE role_id='$r->role_id' ORDER BY id ASC LIMIT 1")->row_array();

				$sub_array = array();
				$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
				$sub_array[] =  '<div class="text-left font-weight-bold">
								<span class="text-danger">' . $r->kode . '</span>
								<br>
								' . $r->nama . '
								</div>';
				$sub_array[] =  '<div class="text-center">' . $r->role . '</div>';
				$sub_array[] =  '<div class="text-center">' . floatval(($custom_revenue['komisi'] != '' ? $custom_revenue['komisi'] :  $default_revenue['komisi']))  . '%' . '</div>';
				$sub_array[] =  '<div class="text-center">' . ($custom_revenue['nmi'] != '' ? $custom_revenue['nmi'] . '%' : '<i>-</i>')   . '</div>';
				$sub_array[] =  '<div class="text-center">' . ($custom_revenue['allowance'] != '' ? 'IDR ' . rupiah($custom_revenue['allowance']) : '<i>-</i>')   . '</div>';
				$sub_array[] =  '<div class="text-center">
								<div class="btn-group">
									<button id="modalEdit" data-href="' . base_url('dashboard/setting/modal_editAllowance/' . $r->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
								</div>
							</div>';
				$data[] = $sub_array;
				$no++;
			}
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->model->get_all_data_list(),
			"recordsFiltered" => $this->model->get_filtered_data_list(),
			"data" => $data
		);
		echo json_encode($output);
	}





	// ################################################
	# TEST REVENUE

	public function test_komisi()
	{
		$this->load->model('Allowance_request_model', 'Allowance_request');

		$this->form_validation->set_rules('mkt_id', 'Sales', 'trim|numeric|required');
		$this->form_validation->set_rules('lot', 'LOT', 'trim|numeric|required|greater_than_equal_to[0]');
		$this->form_validation->set_rules('usd', 'USD per LOT', 'trim|numeric|required|greater_than_equal_to[0]');

		$this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

		if ($this->form_validation->run() === FALSE) {

			$main['table'] = [];
		} else {
			$main['table'] = [];
			$sisa_persen_komisi = 96;

			$lot = $this->input->post('lot');
			$usd = $this->input->post('usd');

			$parents = $this->tree->get_all_parent_id($this->input->post('mkt_id'));

			$count_parents = count($parents);
			$i = 0;
			foreach ($parents as $parent) {

				$jumlah = $lot * $usd;

				$mkt = $this->get_data_mkt($parent);


				if (++$i === $count_parents) { // jika terakhir
					$komisi_usd = $jumlah * ($sisa_persen_komisi / 100);
					$persen_komisi = $sisa_persen_komisi;
				} else {
					$persen_komisi = $this->komisi_byId($parent, $mkt['role_id']);
					$sisa_persen_komisi -= $persen_komisi;
					$komisi_usd = $jumlah * ($persen_komisi / 100);
				}

				$row = [
					'mitra' => '<div class="text-left font-weight-bold">
									<span class="text-danger">' . $mkt['kode'] . '</span>
									<br>
									' . $mkt['nama'] . '
								</div>',
					'jabatan' => '<div class="text-center">' . $mkt['role'] . '</div>',
					'komisi_persen' => '<div class="text-center">' . floatval($persen_komisi) . '%' . '</div>',
					'komisi_usd' => '<div class="text-center">' . rupiah($komisi_usd) . '</div>',
				];
				array_push($main['table'], $row);
			}
		}

		$this->viewku->title("Perhitungan komisi");
		$this->viewku->view("setting/test_komisi.php", $main);
	}

	private function get_data_mkt($id)
	{
		return $this->db->query("SELECT marketing.*, marketing_role.role FROM marketing, marketing_role WHERE marketing.id='$id' AND marketing.role_id=marketing_role.id")->row_array();
	}

	private function komisi_byId($mkt_id, $role_id)
	{
		// cek apakah ada komisi custom
		$query1 = $this->db->query("SELECT komisi FROM marketing_custom_revenue WHERE marketing_id='$mkt_id' AND komisi!='' AND komisi IS NOT NULL");
		if ($query1->num_rows() > 0) {
			$result1 = $query1->row_array();

			$komisi = $result1['komisi'];
		} else { // komisi default

			$result2 = $this->db->query("SELECT komisi FROM marketing_setting_revenue WHERE role_id='$role_id' ORDER BY id ASC LIMIT 1")->row_array();
			$komisi = $result2['komisi'];
		}

		return $komisi;
	}
}
