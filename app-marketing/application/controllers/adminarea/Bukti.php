<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bukti extends CI_Controller {

	   function __construct() {
	   parent::__construct();
	   $this->load->model('Nasabah_model');
	   $this->load->model('Acc_trading_model');
	   // cekLogin();
    }
	
	public function index(){
		// $data['acc'] = $this->Acc_trading_model->get_by_id_nasabah($this->session->userdata('cd_id'));
		$this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/perjanjian');
        $this->load->view('templates/footer');
	}

	public function Konfirmasi()
	{
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$email = $this->session->userdata('nsb_email');
		$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();
        $html =  $this->load->view('kabinet/buktiKonfirmasi',$data,true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('buktiKonfirmasi.pdf', array("Attachment" => false));
		}


		


}
 