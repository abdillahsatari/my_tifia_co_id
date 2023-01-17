<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Nmi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model(['sales/Nmi_model' => 'model']);
	}

	public function index()
	{
		$data['title'] = 'List NMI';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Marketing' => '#',
			'NMI' => '#',
			'List NMI' => '#',
		];
		$data['page'] = 'admin_marketing/nmi/list';
		$this->load->view('template/backend', $data);
	}

	public function add()
	{
		$data['mitra'] = $this->db->query('SELECT marketing.*, marketing_role.role FROM marketing, marketing_role WHERE marketing.role_id=marketing_role.id AND marketing.status_verify="Y"')->result();

		$data['nmi'] = [
			'id' => '',
			'status' => NULL,
			'date_added' => new_date(),
			'kode' => 'NMI',
			'marketing_id' => '',
			'marketing_id' => '',
		];
		$data['action'] = base_url('adminarea/marketing/nmi/add_action');

		$data['title'] = 'Input NMI';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Marketing' => '#',
			'NMI' => '#',
			'Input NMI' => '#',
		];
		$data['page'] = 'admin_marketing/nmi/view';
		$this->load->view('template/backend', $data);
	}

	public function add_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			$this->form_validation->set_rules('mitra_id', 'mitra', 'trim|numeric|required');
			$this->form_validation->set_error_delimiters('<small class="text-danger invalid-feedback-show">', '</small>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();
				$mitra_id = $this->input->post('mitra_id');

				// Start database transaction
				$this->db->trans_start();


				$marketing_nmi = [
					'marketing_id' => $mitra_id,
					'date_added' => $date,
					'status' => NULL
				];
				$this->db->insert('marketing_nmi', $marketing_nmi);
				$id_marketing_nmi = $this->db->insert_id();

				$kode = 'NMI-' . generate_kd(6, $id_marketing_nmi);
				$this->db->update('marketing_nmi', ['kode' => $kode], ['id' => $id_marketing_nmi]);


				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Tambah NMI gagal';
				} else {
					$json['success'] = true;
					$json['alert'] = 'Tambah NMI berhasil';
					$json['href'] = base_url('adminarea/marketing/nmi/view/' . $id_marketing_nmi);
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	public function view($id)
	{
		$data['nmi'] = $this->db->query('SELECT * FROM marketing_nmi WHERE marketing_nmi.id=' . $id)->row_array();
		if ($data['nmi']) {

			$data['mitra'] = $this->db->query('SELECT marketing.*, marketing_role.role FROM marketing, marketing_role WHERE marketing.role_id=marketing_role.id AND marketing.status_verify="Y"')->result();
			$data['action'] = '#';
			$data['nmi_list'] = $this->db->query('SELECT * FROM marketing_nmi_list WHERE is_deleted="0"')->result();

			$data['title'] = 'View NMI';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Marketing' => '#',
				'NMI' => '#',
				'View NMI' => '#',
			];
			$data['page'] = 'admin_marketing/nmi/view';
			$this->load->view('template/backend', $data);
		} else {
			$this->add();
		}
	}

	public function list_action($tipe = 'tambah')
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];


			$this->form_validation->set_rules('marketing_nmi_id', 'marketing_nmi_id', 'trim|numeric|required');
			if ($tipe != 'tambah') {
				$this->form_validation->set_rules('marketing_nmi_list_id', 'marketing_nmi_list_id', 'trim|numeric|required');
			}
			$this->form_validation->set_rules('no_akun', 'no akun', 'trim|required|numeric');
			$this->form_validation->set_rules('total_lot', 'total lot', 'trim|required|numeric|greater_than[0]');
			$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|xss_clean');
			$this->form_validation->set_rules('margin', 'margin', 'trim|required|numeric|greater_than[0]');
			$this->form_validation->set_rules('nmi_percentage', 'nmi percentage', 'trim|required|numeric|greater_than[0]');
			$this->form_validation->set_rules('total', 'total', 'trim|required|numeric|greater_than[0]');

			$this->form_validation->set_error_delimiters('<small class="text-danger invalid-feedback-show">', '</small>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();
				$marketing_nmi_id = $this->input->post('marketing_nmi_id');

				// Start database transaction
				$this->db->trans_start();

				if ($tipe == 'tambah') {
					$marketing_nmi_list = [
						'marketing_nmi_id' => $marketing_nmi_id,
						'no_akun' => $this->input->post('no_akun'),
						'total_lot' => $this->input->post('total_lot'),
						'deskripsi' => $this->input->post('deskripsi'),
						'margin' => $this->input->post('margin'),
						'nmi_percentage' => $this->input->post('nmi_percentage'),
						'total' => $this->input->post('total'),
						'date_added' => $date,
						'is_active' => '1',
						'is_deleted' => '0'
					];
					$this->db->insert('marketing_nmi_list', $marketing_nmi_list);
				} elseif ($tipe == 'update') {
					$marketing_nmi_list = [
						'no_akun' => $this->input->post('no_akun'),
						'total_lot' => $this->input->post('total_lot'),
						'deskripsi' => $this->input->post('deskripsi'),
						'margin' => $this->input->post('margin'),
						'nmi_percentage' => $this->input->post('nmi_percentage'),
						'total' => $this->input->post('total'),
						'date_updated' => $date
					];
					$this->db->update('marketing_nmi_list', $marketing_nmi_list, ['id' => $this->input->post('marketing_nmi_list_id')]);
				}

				$this->calculate_nmi($marketing_nmi_id);

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = $tipe . ' NMI list gagal';
				} else {
					$json['success'] = true;
					$json['alert'] = $tipe . ' NMI list berhasil';
					$json['href'] = base_url('adminarea/marketing/nmi/view/' . $marketing_nmi_id);
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	public function modal_nmiList($marketing_nmi_id, $marketing_nmi_list_id = '')
	{
		if ($marketing_nmi_list_id != '') {
			$nmi = $this->db->query('SELECT * FROM marketing_nmi_list WHERE id=' . $marketing_nmi_list_id)->row_array();
			$action =  base_url('adminarea/marketing/nmi/list_action/update');
		} else {
			$nmi = [
				'id' => '',
				'marketing_nmi_id' => '',
				'no_akun' => '',
				'total_lot' => '',
				'deskripsi' => '',
				'margin' => '',
				'nmi_percentage' => '',
				'total' => '',
			];
			$action =  base_url('adminarea/marketing/nmi/list_action/tambah');
		}

		echo '
		<form action="' . $action . '" method="post" class="form">

			<input type="hidden" name="marketing_nmi_id" value="' . $marketing_nmi_id . '">
			<input type="hidden" name="marketing_nmi_list_id" value="' . $marketing_nmi_list_id . '">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">ID Akun</label>
				<div class="col-sm-10">
					<input class="form-control" type="number" name="no_akun" id="no_akun" placeholder="No Akun" value="' . $nmi['no_akun'] . '">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Total LOT</label>
				<div class="col-sm-10">
					<input class="form-control" type="number" min="0" name="total_lot" id="total_lot" placeholder="total lot" value="' . floatval($nmi['total_lot']) . '">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Deskripsi</label>
				<div class="col-sm-10">
					<textarea name="deskripsi" id="deskripsi" cols="20" rows="10" class="form-control">' . $nmi['deskripsi'] . '</textarea>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Margin</label>
				<div class="col-sm-10">
					<input class="form-control" type="number" name="margin" id="margin" placeholder="Margin" value="' . floatval($nmi['margin']) . '">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NMI</label>
				<div class="col-sm-10">
					<div class="input-group">
						<input class="form-control" type="number" min="0" name="nmi_percentage" id="nmi_percentage" placeholder="NMI percentage" value="' . floatval($nmi['nmi_percentage']) . '">
						<span class="input-group-addon">%</span>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Total</label>
				<div class="col-sm-10">
					<input class="form-control" type="number" name="total" id="total" placeholder="Total" value="' . floatval($nmi['total']) . '">
				</div>
			</div>

			<div class="text-center">
				<button class="btn btn-primary" id="submit">' . ($marketing_nmi_list_id == '' ? 'Tambah' : 'Update') . '</button>
			</div>

		</form>
		';
	}

	private function calculate_nmi($marketing_nmi_id)
	{
		$grand_total = $this->db->query("SELECT SUM(total) as grand_total FROM marketing_nmi_list WHERE marketing_nmi_id='$marketing_nmi_id' AND is_active='1' AND is_deleted='0'")->row_array()['grand_total'];
		$this->db->update('marketing_nmi', ['grand_total' => $grand_total], ['id' => $marketing_nmi_id]);
		return $grand_total;
	}

	public function sendRequest($marketing_nmi_id)
	{
		$query = $this->db->get_where('marketing_nmi', ['id' => $marketing_nmi_id, 'status' => NULL]);
		if ($query->num_rows() > 0) {

			$grand_total = $this->calculate_nmi($marketing_nmi_id);
			if ($grand_total > 0) {
				$marketing_nmi = [
					'date_requested' => new_date(),
					'status' => 'Requested'
				];
				$this->db->update('marketing_nmi', $marketing_nmi);
				$this->session->set_flashdata('message', 'Request berhasil dikirim');
			} else {
				$this->session->set_flashdata('message', 'Mohon untuk menambah list NMI');
			}

			redirect('adminarea/marketing/nmi/view/' . $marketing_nmi_id);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect('adminarea/marketing/nmi');
		}
	}

	public function delete($marketing_nmi_id)
	{
		$query = $this->db->get_where('marketing_nmi', ['id' => $marketing_nmi_id, 'status' => NULL]);
		if ($query->num_rows() > 0) {

			$this->db->delete('marketing_nmi_list', ['marketing_nmi_id' => $marketing_nmi_id]);
			$this->db->delete('marketing_nmi', ['id' => $marketing_nmi_id]);

			$this->session->set_flashdata('message', 'NMI berhasil dihapus');
			redirect('adminarea/marketing/nmi/index');
		} else {
			$this->session->set_flashdata('message', 'Record Not Found atau NMI telah diproses');
			redirect('adminarea/marketing/nmi');
		}
	}

	// ################################################
	// datatables
	function fetch_list()
	{

		$status = '';

		$fetch_data = $this->model->make_datatables_list($status);
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			$sub_array = array();
			$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->date_added) . '</div>';
			$sub_array[] =  '<div class="text-center">' . '<b class="text-danger">' . $r->kode . '</b></div>';
			$sub_array[] =  '<div class="text-left">
								<a href="' . base_url('adminarea/marketing/sales/view/' . $r->marketing_id) . '" class="text-danger">' . $r->kode_sales . '</a>
								<br>
								' . $r->nama_sales . '
								</div>';
			$sub_array[] =  '<div class="text-center">' . rupiah($r->grand_total) . '</div>';
			$sub_array[] =  '<div class="text-center"><code>' . $r->status . '</code></div>';
			$sub_array[] =  '<div class="text-center">
								<div class="btn-group">
									<a href="' . base_url('adminarea/marketing/nmi/view/' . $r->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-' . ($r->status == NULL ? 'edit' : 'eye') . '"></i></a>' .
				($r->status == NULL ? '<a href="#" data-href="' . base_url('adminarea/marketing/nmi/delete/' . $r->id) . '" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash-o"></i></a>' : '')
				. '</div>
							</div>';
			$data[] = $sub_array;
			$no++;
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->model->get_all_data_list($status),
			"recordsFiltered" => $this->model->get_filtered_data_list($status),
			"data" => $data
		);
		echo json_encode($output);
	}
}
