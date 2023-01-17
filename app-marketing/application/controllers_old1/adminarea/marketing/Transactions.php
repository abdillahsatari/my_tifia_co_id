<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transactions extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model(['sales/Transactions_model' => 'model']);
		$this->load->library('Tree');
	}

	public function index()
	{
		$this->trading();
	}

	// TRANSAKSI TRADING

	public function trading()
	{
		$data['title'] = 'Transaksi Trading Nasabah';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Marketing' => '#',
			'Calon nasabah' => '#',
		];
		$data['page'] = 'admin_marketing/transactions/transaksi_trading';
		$this->load->view('template/backend', $data);
	}

	// Simulasi Komisi LOT
	public function tambahTransaksi_action()
	{
		if ($this->input->is_ajax_request()) {
			$json = ['form_validation' => false, 'success' => false, 'alert' => array()];

			$this->form_validation->set_rules('no_akun', 'akun trading', 'trim|numeric|required');
			$this->form_validation->set_rules('lot', 'LOT', 'trim|numeric|required|greater_than_equal_to[0]');
			$this->form_validation->set_rules('usd', 'USD per LOT', 'trim|numeric|required|greater_than_equal_to[0]');
			$this->form_validation->set_rules('tipe', 'tipe', 'trim|required|in_list[sell,buy]');

			$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

			if ($this->form_validation->run()) {
				$json['form_validation'] = TRUE;

				$date = new_date();
				$sisa_persen_komisi = 99;

				// Start database transaction
				$this->db->trans_start();

				$lot = $this->input->post('lot');
				$usd = $this->input->post('usd');
				$no_akun = $this->input->post('no_akun');

				// get withdrawal rate
				$query = $this->db->query('SELECT acc_currency.withdraw_rate FROM acc_trading, acc_currency WHERE acc_trading.acc_currency_id=acc_currency.acc_currency_id AND acc_trading.no_akun="' . $no_akun . '"')->row_array();
				$wd_rate = $query['withdraw_rate'];

				$nasabah_transaksi_trading = [
					'kode' => 0,
					'no_akun' => $no_akun,
					'lot' => $lot,
					'tipe' => $this->input->post('tipe'),
					'date' => $date,
					'is_komisi_processed' => '1',
					'date_komisi_processed' => $date,
				];
				$this->db->insert('nasabah_transaksi_trading', $nasabah_transaksi_trading);
				$nasabah_transaksi_trading_id = $this->db->insert_id();

				# Pembagian Komisi
				// get parent marketing
				$acc_trading = $this->db->query('SELECT nasabah_id FROM acc_trading WHERE no_akun="' . $no_akun . '"')->row_array();
				$nasabah = $this->db->query('SELECT parent_id, email FROM nasabah WHERE nasabah_id="' . $acc_trading['nasabah_id'] . '"')->row_array();
				$parents = $this->tree->get_all_parent_id($nasabah['parent_id']);

				// var_dump($parents);
				// echo '<br>';

				$count_parents = count($parents);
				$i = 0;
				foreach ($parents as $parent) {

					$jumlah = $lot * $usd;

					$mkt = $this->get_data_mkt($parent);

					if (++$i === $count_parents) { // jika terakhir

						if ($mkt['role_id'] == 1) { // jika DIRUT
							$persen_komisi = $sisa_persen_komisi + 1;
							$komisi_usd = $jumlah * ($persen_komisi / 100);
						} else { // Selain DIRUT
							$komisi_usd = $jumlah * ($sisa_persen_komisi / 100);
							$persen_komisi = $sisa_persen_komisi;
						}
					} else {
						$persen_komisi = $this->komisi_byId($parent);
						$sisa_persen_komisi -= $persen_komisi;
						$komisi_usd = $jumlah * ($persen_komisi / 100);

						if ($nasabah['parent_id'] == $parent) { // jika nasabah merupakan anak mitra

							for ($rolee = $mkt['role_id'] + 1; $rolee <= 5; $rolee++) {
								$persen_komisi2 = $this->komisi_byRole($rolee);
								$sisa_persen_komisi -= $persen_komisi2;
								$komisi_usd2 = $jumlah * ($persen_komisi2 / 100);

								// if ($komisi_usd2 > 0) {

								// insert komisi marketing
								$marketing_komisi = [
									'marketing_id' => $parent,
									'nasabah_transaksi_trading_id' => $nasabah_transaksi_trading_id,
									'amount_usd' => $komisi_usd2,
									'amount' => $komisi_usd2 * $wd_rate,
									'date' => $date,
								];
								$this->db->insert('marketing_komisi', $marketing_komisi);
								$marketing_komisi_id = $this->db->insert_id();

								// insert log
								$marketing_log = [
									'marketing_id' => $parent,
									'summary' => "marketing_komisi[$marketing_komisi_id]",
									'tipe' => 'menerima komisi',
									'aktifitas' => 'Menerima komisi dari [' . $nasabah['email'] . ']',
									'date' => $date
								];
								$this->db->insert('marketing_log', $marketing_log);

								// echo '[' . $parent . '] ' . $this->username($parent) . ' - ' . $persen_komisi2 . '%, amount $' . $komisi_usd2 . '<br>';
								// }
							}
						}
					}


					// if ($komisi_usd > 0) {

					// insert komisi marketing
					$marketing_komisi = [
						'marketing_id' => $parent,
						'nasabah_transaksi_trading_id' => $nasabah_transaksi_trading_id,
						'amount_usd' => $komisi_usd,
						'amount' => $komisi_usd * $wd_rate,
						'date' => $date,
					];
					$this->db->insert('marketing_komisi', $marketing_komisi);
					$marketing_komisi_id = $this->db->insert_id();

					// insert log
					$marketing_log = [
						'marketing_id' => $parent,
						'summary' => "marketing_komisi[$marketing_komisi_id]",
						'tipe' => 'menerima komisi',
						'aktifitas' => 'Menerima komisi dari [' . $nasabah['email'] . ']',
						'date' => $date
					];
					$this->db->insert('marketing_log', $marketing_log);

					// echo '[' . $parent . '] ' . $this->username($parent) . ' - ' . $persen_komisi . '%, amount $' . $komisi_usd . '<br>';
					// }
				}

				// echo '<br>---------------------------------------------------------------------------<br><br>';
				// }

				// End transaction
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					$json['alert'] = 'Pembagian komisi gagal';
				} else {
					$json['success'] = true;
					$json['alert'] = 'Pembagian komisi berhasil';
				}
			} else {
				foreach ($_POST as $key => $value) {
					$json['alert'][$key] = form_error($key);
				}
			}
			echo json_encode($json);
		}
	}

	private function get_data_mkt($id)
	{
		return $this->db->query("SELECT marketing.*, marketing_role.role FROM marketing, marketing_role WHERE marketing.id='$id' AND marketing.role_id=marketing_role.id")->row_array();
	}

	private function komisi_byId($mkt_id)
	{
		$role_id = my_role_id($mkt_id);

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

	private function komisi_byRole($role_id)
	{
		$result2 = $this->db->query("SELECT komisi FROM marketing_setting_revenue WHERE role_id='$role_id' ORDER BY id ASC LIMIT 1")->row_array();
		return $result2['komisi'];
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "Transaksi trading nasabah (" . new_date() . ").xls";
		$judul = "Transaksi trading nasabah";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Kode Transaksi");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Lengkap");
		xlsWriteLabel($tablehead, $kolomhead++, "No. Akun Trading");
		xlsWriteLabel($tablehead, $kolomhead++, "Lot");
		xlsWriteLabel($tablehead, $kolomhead++, "Tipe");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");

		foreach ($this->model->get_all() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->kode);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
			xlsWriteLabel($tablebody, $kolombody++, $data->no_akun);
			xlsWriteLabel($tablebody, $kolombody++, $data->lot);
			xlsWriteLabel($tablebody, $kolombody++, $data->tipe);
			xlsWriteLabel($tablebody, $kolombody++, $data->date);

			$tablebody++;
			$nourut++;
		}



		xlsEOF();
		exit();
	}

	// ################################################
	// datatables

	function fetch_transaksi_trading()
	{
		$fetch_data = $this->model->make_datatables_transaksi_trading();
		$data = array();
		$no = 1;
		foreach ($fetch_data as $r) {

			$sub_array = array();
			$sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
			$sub_array[] =  '<div class="text-center font-weight-bold">
								<span class="text-danger">' . $r->kode . '</span>
								</div>';
			$sub_array[] =  '<div class="text-left">
								<span class="text-danger">' . $r->no_akun . '</span>
								<br>
								' . $r->nama_lengkap . '
								</div>';
			$sub_array[] =  '<div class="text-center">' . $r->lot . '</div>';
			$sub_array[] =  '<div class="text-center">' . $r->tipe . '</div>';
			$sub_array[] =  '<div class="text-center">' . date_tampil($r->date) . '</div>';
			// $sub_array[] =  '<div class="text-center">
			// 					<div class="btn-group">
			// 						<a href="#" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
			// 					</div>
			// 				</div>';
			$sub_array[] =  '';

			$data[] = $sub_array;
			$no++;
		}
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->model->get_all_data_transaksi_trading(),
			"recordsFiltered" => $this->model->get_filtered_data_transaksi_trading(),
			"data" => $data
		);
		echo json_encode($output);
	}


	// ###############################################################################

	private function fix_allowance()
	{
		// Start db transactions
		$this->db->trans_begin();

		$marketing_komisi = $this->db->query('SELECT * FROM marketing_komisi WHERE id>=99 AND id<=310')->result();
		foreach ($marketing_komisi as $r) {

			$this->db->delete('marketing_log', ['summary' => 'marketing_komisi[' . $r->id . ']']);
		}


		$nasabah_transaksi_trading = $this->db->query('SELECT * FROM nasabah_transaksi_trading WHERE id>=32 AND id<=75')->result();
		// $nasabah_transaksi_trading = $this->db->query('SELECT nasabah_transaksi_trading.*, nasabah.nama_lengkap, nasabah.parent_id FROM nasabah_transaksi_trading, acc_trading, acc_request, nasabah WHERE nasabah_transaksi_trading.id>=32 AND nasabah_transaksi_trading.id<=75 AND nasabah_transaksi_trading.no_akun=acc_trading.no_akun AND acc_trading.acc_request_id=acc_request.acc_request_id AND acc_request.nasabah_id=nasabah.nasabah_id')->result();
		foreach ($nasabah_transaksi_trading as $ntt) {


			$no_akun = $ntt->no_akun;
			$lot = $ntt->lot;
			if ($no_akun == '87052101') $usd = 5;
			elseif ($no_akun == '87510102') $usd = 30;
			$nasabah_transaksi_trading_id = $ntt->id;
			$date = $ntt->date_komisi_processed;
			$sisa_persen_komisi = 99; // 96


			// echo $ntt->id . '. [parent:' . $ntt->parent_id . '] ' . $ntt->nama_lengkap . ': ' . $ntt->no_akun . ' (' . $ntt->lot . ' lot / usdperlot ' . $usd . ')<br>';
			echo $ntt->id . ': ' . $ntt->no_akun . ' (' . $ntt->lot . ' lot / usdperlot ' . $usd . ')<br>';

			// hapus mkt_komisi
			$this->db->delete('marketing_komisi', ['nasabah_transaksi_trading_id' => $ntt->id]);

			// get withdrawal rate
			$query = $this->db->query('SELECT acc_currency.withdraw_rate FROM acc_trading, acc_currency WHERE acc_trading.acc_currency_id=acc_currency.acc_currency_id AND acc_trading.no_akun="' . $no_akun . '"')->row_array();
			$wd_rate = $query['withdraw_rate'];

			# Pembagian Komisi
			// get parent marketing
			$acc_trading = $this->db->query('SELECT nasabah_id FROM acc_trading WHERE no_akun="' . $no_akun . '"')->row_array();
			$nasabah = $this->db->query('SELECT parent_id, email FROM nasabah WHERE nasabah_id="' . $acc_trading['nasabah_id'] . '"')->row_array();
			$parents = $this->tree->get_all_parent_id($nasabah['parent_id']);

			var_dump($parents);
			echo '<br>';

			$count_parents = count($parents);
			$i = 0;
			foreach ($parents as $parent) {

				$jumlah = $lot * $usd;

				$mkt = $this->get_data_mkt($parent);

				if (++$i === $count_parents) { // jika terakhir

					if ($mkt['role_id'] == 1) { // jika DIRUT
						$persen_komisi = $sisa_persen_komisi + 1;
						$komisi_usd = $jumlah * ($persen_komisi / 100);
					} else { // Selain DIRUT
						$komisi_usd = $jumlah * ($sisa_persen_komisi / 100);
						$persen_komisi = $sisa_persen_komisi;
					}
				} else {
					$persen_komisi = $this->komisi_byId($parent);
					$sisa_persen_komisi -= $persen_komisi;
					$komisi_usd = $jumlah * ($persen_komisi / 100);

					if ($nasabah['parent_id'] == $parent) { // jika nasabah merupakan anak mitra

						for ($rolee = $mkt['role_id'] + 1; $rolee <= 5; $rolee++) {
							$persen_komisi2 = $this->komisi_byRole($rolee);
							$sisa_persen_komisi -= $persen_komisi2;
							$komisi_usd2 = $jumlah * ($persen_komisi2 / 100);

							// if ($komisi_usd2 > 0) {

							// insert komisi marketing
							$marketing_komisi = [
								'marketing_id' => $parent,
								'nasabah_transaksi_trading_id' => $nasabah_transaksi_trading_id,
								'amount_usd' => $komisi_usd2,
								'amount' => $komisi_usd2 * $wd_rate,
								'date' => $date,
							];
							$this->db->insert('marketing_komisi', $marketing_komisi);
							$marketing_komisi_id = $this->db->insert_id();

							// insert log
							$marketing_log = [
								'marketing_id' => $parent,
								'summary' => "marketing_komisi[$marketing_komisi_id]",
								'tipe' => 'menerima komisi',
								'aktifitas' => 'Menerima komisi dari [' . $nasabah['email'] . ']',
								'date' => $date
							];
							$this->db->insert('marketing_log', $marketing_log);

							echo '[' . $parent . '] ' . $this->username($parent) . ' - ' . $persen_komisi2 . '%, amount $' . $komisi_usd2 . '<br>';
							// }
						}
					}
				}


				// if ($komisi_usd > 0) {

				// insert komisi marketing
				$marketing_komisi = [
					'marketing_id' => $parent,
					'nasabah_transaksi_trading_id' => $nasabah_transaksi_trading_id,
					'amount_usd' => $komisi_usd,
					'amount' => $komisi_usd * $wd_rate,
					'date' => $date,
				];
				$this->db->insert('marketing_komisi', $marketing_komisi);
				$marketing_komisi_id = $this->db->insert_id();

				// insert log
				$marketing_log = [
					'marketing_id' => $parent,
					'summary' => "marketing_komisi[$marketing_komisi_id]",
					'tipe' => 'menerima komisi',
					'aktifitas' => 'Menerima komisi dari [' . $nasabah['email'] . ']',
					'date' => $date
				];
				$this->db->insert('marketing_log', $marketing_log);

				echo '[' . $parent . '] ' . $this->username($parent) . ' - ' . $persen_komisi . '%, amount $' . $komisi_usd . '<br>';
				// }
			}

			// echo '<br>---------------------------------------------------------------------------<br><br>';
			// }
		}


		if ($this->db->trans_status() === TRUE) {
			$this->db->trans_commit();
		} else {
			$this->db->trans_rollback();
		}
	}

	function username($id_mitra)
	{
		return $this->db->query('SELECT nama FROM marketing WHERE id=' . $id_mitra)->row_array()['nama'];
	}
}


// SELECT marketing_komisi.*, marketing.nama FROM marketing_komisi, marketing WHERE marketing_komisi.id>=99 AND marketing_komisi.id<=310 AND marketing_komisi.marketing_id=marketing.id

// SELECT nasabah_transaksi_trading.*, nasabah.nama_lengkap FROM nasabah_transaksi_trading, acc_trading, acc_request, nasabah WHERE nasabah_transaksi_trading.id>=32 AND nasabah_transaksi_trading.id<=75 AND nasabah_transaksi_trading.no_akun=acc_trading.no_akun AND acc_trading.acc_request_id=acc_request.acc_request_id AND acc_request.nasabah_id=nasabah.nasabah_id GROUP BY nasabah_transaksi_trading.no_akun

// SELECT * FROM `marketing_komisi` WHERE nasabah_transaksi_trading_id>=32 AND nasabah_transaksi_trading_id<=75
// SELECT * FROM `marketing_komisi` WHERE nasabah_transaksi_trading_id>=32 AND nasabah_transaksi_trading_id<=75 AND amount<=0 GROUP BY marketing_id