<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//		$this->layout->auth();
		$this->load->model(array('Log_model', 'Nasabah_model', 'Deposit_model', 'Withdraw_model'));
	}

	public function index()
	{
		// $user = $this->ion_auth->user()->row();
		// $data['log'] = $this->Log_model->get_by_user_id($user->id);

		// nasabah
		$data['nsb']['nasabah'] = $this->Nasabah_model->get_count();
		$data['nsb']['deposit'] = $this->Deposit_model->get_sum_all()->jml;
		$data['nsb']['withdrawal'] = $this->Withdraw_model->get_sum_all()->jml;

		// mitra
		$data['mkt']['mitra'] = $this->db->query('SELECT id FROM marketing WHERE status_verify="Y"')->num_rows();
		$data['mkt']['hot_prospek'] = $this->db->query('SELECT id FROM calon_nasabah WHERE prioritas="Hot prospek"')->num_rows();
		$data['mkt']['withdrawal'] = $this->db->query('SELECT SUM(amount_bersih) AS total FROM marketing_allowance WHERE status="Approved"')->row_array()['total'];

		// chart
		$data['chart']['omset_wd'] = $this->chart_omset_wd();
		$data['chart']['allowance'] = $this->chart_allowance_komisi();


		$data['title'] = 'Dashboard';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Dashboard' => '',
		];
		//$this->layout->set_privilege(1);
		$data['code_js'] = 'Dashboard/codejs';
		$data['page'] = 'Dashboard/Index';
		$this->load->view('template/backend', $data);
	}

	private function chart_omset_wd()
	{
		$data = [];

		$hari_ini = new_date();
		// $day = date('d', strtotime($hari_ini));
		// $month = date('m', strtotime($hari_ini));
		$year = date('Y', strtotime($hari_ini));

		for ($month = 1; $month <= 12; $month++) {
			$dp = $this->db->query('SELECT SUM(total) as total FROM deposit WHERE (status_deposit!="Pending" AND status_deposit!="Reject") AND MONTH(tanggal_konfirmasi) = "' . $month . '" AND YEAR(tanggal_konfirmasi) = "' . $year . '"')->row_array();

			$wd = $this->db->query('SELECT SUM(total) as total FROM withdraw WHERE status_withdraw="Done" AND MONTH(tanggal_konfirmasi) = "' . $month . '" AND YEAR(tanggal_konfirmasi) = "' . $year . '"')->row_array();

			$array = [
				'y' => date('F', mktime(0, 0, 0, $month, 10)),
				'a' => ($dp['total'] > 0 ? $dp['total'] : 0),
				'b' => ($wd['total'] > 0 ? $wd['total'] : 0)
			];
			array_push($data, $array);
		}

		return json_encode($data);
	}

	private function chart_allowance_komisi()
	{
		$data = [];

		$hari_ini = new_date();
		// $day = date('d', strtotime($hari_ini));
		// $month = date('m', strtotime($hari_ini));
		$year = date('Y', strtotime($hari_ini));

		for ($month = 1; $month <= 12; $month++) {
			$allowance = $this->db->query('SELECT SUM(amount_bersih) as total FROM marketing_allowance WHERE status="Approved" AND MONTH(date_updated) = "' . $month . '" AND YEAR(date_updated) = "' . $year . '"')->row_array();

			$komisi = $this->db->query('SELECT SUM(amount) as total FROM marketing_komisi WHERE MONTH(date) = "' . $month . '" AND YEAR(date) = "' . $year . '"')->row_array();

			$array = [
				'y' => $year . '-' . $month,
				'a' => ($allowance['total'] > 0 ? $allowance['total'] : 0),
				'b' => ($komisi['total'] > 0 ? $komisi['total'] : 0)
			];
			array_push($data, $array);
		}

		return json_encode($data);
	}
}
