<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Nmi_request extends CI_Controller
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
		$data['title'] = 'NMI Request';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Marketing' => '#',
			'NMI' => '#',
			'NMI Request' => '#',
		];
		$data['page'] = 'admin_marketing/nmi/request';
		$this->load->view('template/backend', $data);
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
			$data['page'] = 'admin_marketing/nmi/preview';
			$this->load->view('template/backend', $data);
		} else {
			redirect('adminarea/marketing/nmi_request');
		}
	}

	public function konfirmasi($tipe, $marketing_nmi_id)
	{
		$query = $this->db->get_where('marketing_nmi', ['id' => $marketing_nmi_id, 'status' => 'Requested']);
		if ($query->num_rows() > 0) {

			$marketing_nmi = [
				'date_confirmed' => new_date(),
				'status' => $tipe,
				'approve_admin_id' => $this->session->userdata('user_id')
			];
			$this->db->update('marketing_nmi', $marketing_nmi);
			$this->session->set_flashdata('message', 'NMI ' . $tipe);

			redirect('adminarea/marketing/nmi_request/view/' . $marketing_nmi_id);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect('adminarea/marketing/nmi_request');
		}
	}

	// ################################################
	// datatables
	function fetch_list()
	{

		$status = 'Requested';

		$fetch_data = $this->model->make_datatables_list($status);
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			$sub_array = array();
			$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->date_requested) . '</div>';
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
									<a href="' . base_url('adminarea/marketing/nmi_request/view/' . $r->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a></div>
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
