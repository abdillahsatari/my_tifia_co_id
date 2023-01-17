<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		$this->load->library('Tree');
		$this->load->model(['Commission_model']);
	}

	public function index()
	{
		$this->viewku->title("Dashboard");

		$role_id = my_role_id(sess('mkt'));
		// jika dirut, maka bisa lihat omset total dan omset child

		$main['top_omset'] = $this->top_omset();
		$main['top_commission'] = $this->top_commission();

		$this->viewku->view("home/index", $main);
	}

	public function test()
	{
		$this->load->helper('send_email');
		$data['email'] = "fasayayaqhsya@gmail.com";
		$data['subjek'] = "Test email lokal";
		$data['pesan'] = "test";
		$msg = send_mailer($data);
		echo $msg['error'];
	}

	private function top_omset()
	{
		$all_omset = [];

		// get all marketing
		$marketing = $this->db->query("SELECT id, nama, kode FROM marketing WHERE role_id!='1'")->result();
		foreach ($marketing as $m) {

			// get all nasabah
			$omset = 0;
			$nasabah = $this->db->query("SELECT nasabah_id, nama_lengkap FROM nasabah WHERE parent_id='$m->id'")->result();
			foreach ($nasabah as $n) {

				// get total deposit nasabah
				$deposit = $this->db->query("SELECT SUM(total) as total_deposit FROM deposit WHERE nasabah_id='$n->nasabah_id' AND (status_deposit='Approve' OR status_deposit='Sukses')")->row_array();
				$omset += $deposit['total_deposit'];
			}

			// push array jika komisi lebih dari 0
			if ($omset > 0)
				array_push($all_omset, ['id' => $m->id, 'nama' => $m->nama, 'kode' => $m->kode, 'total_omset' => $omset]);
		}

		// sort array by value
		array_multisort(array_column($all_omset, 'total_omset'), SORT_DESC, $all_omset);

		// get top 5 omset
		$top_omset = array_slice($all_omset, 0, 5, true);

		return $top_omset;
	}

	private function top_commission()
	{
		$all_commission = [];

		// get mitra saya
		$marketing = $this->db->query("SELECT id, nama, kode FROM marketing WHERE status_verify='Y' AND role_id!='1' ORDER BY date_added ASC")->result();
		foreach ($marketing as $m) {

			$komisi = 0;

			// all komisi
			$marketing_komisi = $this->db->query("SELECT marketing_komisi.marketing_id, acc_trading.nasabah_id, marketing_komisi.amount
										FROM marketing_komisi, nasabah_transaksi_trading, acc_trading 
										WHERE 
											marketing_komisi.marketing_id='$m->id' 
											AND marketing_komisi.nasabah_transaksi_trading_id=nasabah_transaksi_trading.id
											AND nasabah_transaksi_trading.no_akun=acc_trading.no_akun 
										")->result();
			foreach ($marketing_komisi as $mk) {

				// check apakah nasabah mitra
				$cek = $this->Commission_model->apakah_nasabah_saya($mk->nasabah_id, $mk->marketing_id);
				if ($cek == TRUE) {
					$komisi += $mk->amount;
				}
			}

			// push array jika komisi lebih dari 0
			if ($komisi > 0) {
				array_push($all_commission, ['id' => $m->id, 'nama' => $m->nama, 'kode' => $m->kode, 'total_komisi' => $komisi]);
			}
		}

		// sort array by value
		array_multisort(array_column($all_commission, 'total_komisi'), SORT_DESC, $all_commission);

		// get top 5 omset
		$top_commission = array_slice($all_commission, 0, 5, true);

		return $top_commission;
	}
}
