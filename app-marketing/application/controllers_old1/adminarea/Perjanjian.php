<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perjanjian extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model('Nasabah_model');
		$this->load->model('Acc_trading_model');
		$this->load->model('Acc_demo_model');
		$this->load->model('Bank_model');
	}

	// formulir perjanjian review
	public function FormulirPBK01Review($id)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['nasabah']  = $this->Nasabah_model->get_by_id($id);
		$html =  $this->load->view('kabinet/formulir/FormulirPBK01Review', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK01.pdf', array("Attachment" => false));
	}

	public function FormulirPBK02_1Review($id)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['nasabah']  = $this->Nasabah_model->get_by_id($id);
		$data['acc_demo'] = $this->Acc_demo_model->getData($id);


		$html =  $this->load->view('kabinet/formulir/FormulirPBK02_1Review', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK02_1.pdf', array("Attachment" => false));
		// print_r($data['acc_demo'][0]->no_akun);
	}

	public function FormulirPBK02_2Review($id)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['nasabah']  = $this->Nasabah_model->get_by_id($id);
		$data['acc_demo'] = $this->Acc_demo_model->getData($id);
		$html =  $this->load->view('kabinet/formulir/FormulirPBK02_2Review', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK02_2.pdf', array("Attachment" => false));
	}


	public function FormulirPBK03Review($id)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['nasabah']  = $this->Nasabah_model->get_by_id($id);
		$data['bank_idr'] = $this->Bank_model->get_where_IDR($id);
		$html =  $this->load->view('kabinet/formulir/FormulirPBK03Review', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK03.pdf', array("Attachment" => false));
		// print_r($data["bank_idr"][0]);
	}

	public function FormulirPBK04Review($id)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['nasabah']  = $this->Nasabah_model->get_by_id($id);
		// cek tipe
		if ($data['nasabah']->tipe == 'SPA') {
			$html =  $this->load->view('kabinet/formulir/FormulirPBK04Review', $data, true);
		} else {
			$html =  $this->load->view('kabinet/formulir/FormulirPBK04Review_multi', $data, true);
		}
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK04.pdf', array("Attachment" => false));
	}


	public function FormulirPBK05Review($id)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['nasabah']  = $this->Nasabah_model->get_by_id($id);
		// cek tipe
		if ($data['nasabah']->tipe == 'SPA') {
			$html =  $this->load->view('kabinet/formulir/FormulirPBK05Review', $data, true);
		} else {
			$html =  $this->load->view('kabinet/formulir/FormulirPBK05Review_multi', $data, true);
		}
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK05.pdf', array("Attachment" => false));
	}

	public function FormulirPBK06Review($id)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$email = $this->session->userdata('nsb_email');
		$data['nasabah']  = $this->Nasabah_model->get_by_id($id);
		// cek tipe
		if ($data['nasabah']->tipe == 'SPA') {
			$html =  $this->load->view('kabinet/formulir/FormulirPBK06Review', $data, true);
		} else {
			$html =  $this->load->view('kabinet/formulir/FormulirPBK06Review_multi', $data, true);
		}
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK06.pdf', array("Attachment" => false));
	}

	public function FormulirPBK07Review($id)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['nasabah']  = $this->Nasabah_model->get_by_id($id);
		$html =  $this->load->view('kabinet/formulir/FormulirPBK07Review', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK07.pdf', array("Attachment" => false));
	}

	public function FormulirPBK07_2Review($id)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['nasabah']  = $this->Nasabah_model->get_by_id($id);
		$html =  $this->load->view('kabinet/formulir/FormulirPBK07_2Review', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK07.pdf', array("Attachment" => false));
	}





	// formulir perjanjian new type account

	public function FormulirPBK01($noacc)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['user']  = $this->Acc_trading_model->get_by_id_noakun_join($noacc);
		$html =  $this->load->view('kabinet/FormulirPBK01', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK01.pdf', array("Attachment" => false));
	}

	public function FormulirPBK02_1($noacc)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['user']  = $this->Acc_trading_model->get_by_id_noakun_join($noacc);
		$data['noacc'] = $this->Acc_demo_model->getData($data['user']->nasabah_id);
		$html =  $this->load->view('kabinet/FormulirPBK02_1', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK02_1.pdf', array("Attachment" => false));
	}

	public function FormulirPBK02_2($noacc)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['user']  = $this->Acc_trading_model->get_by_id_noakun_join($noacc);
		$data['noacc'] = $this->Acc_demo_model->getData($data['user']->nasabah_id);
		$html =  $this->load->view('kabinet/FormulirPBK02_2', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK02_2.pdf', array("Attachment" => false));
	}

	public function FormulirPBK03($noacc)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['user']  = $this->Acc_trading_model->get_by_id_noakun_join($noacc);
		$data['bank_idr'] = $this->Bank_model->get_where_IDR($data['user']->nasabah_id);
		$html =  $this->load->view('kabinet/FormulirPBK03', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK03.pdf', array("Attachment" => false));
	}

	public function FormulirPBK04($noacc)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['user']  = $this->Acc_trading_model->get_by_id_noakun_join($noacc);
		$html =  $this->load->view('kabinet/FormulirPBK04', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK04.pdf', array("Attachment" => false));
	}

	public function FormulirPBK05($noacc)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['user']  = $this->Acc_trading_model->get_by_id_noakun_join($noacc);
		$html =  $this->load->view('kabinet/FormulirPBK05', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK05.pdf', array("Attachment" => false));
	}

	public function FormulirPBK06()
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$email = $this->session->userdata('nsb_email');
		$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();
		$html =  $this->load->view('kabinet/FormulirPBK06', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK06.pdf', array("Attachment" => false));
	}

	public function FormulirPBK07()
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$email = $this->session->userdata('nsb_email');
		$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();
		$html =  $this->load->view('kabinet/FormulirPBK07', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK07.pdf', array("Attachment" => false));
	}

	public function bukti_konfirmasi($noacc)
	{
		require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$data['user']  = $this->Acc_trading_model->get_by_id_noakun_join($noacc);
		$data['noacc'] = $noacc;
		$html =  $this->load->view('kabinet/buktiKonfirmasi', $data, true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('buktiKonfirmasi.pdf', array("Attachment" => false));
	}
}
