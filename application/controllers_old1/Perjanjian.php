<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perjanjian extends CI_Controller {

	   function __construct() {
	   parent::__construct();
	   $this->load->model('Nasabah_model');
	   $this->load->model('Acc_trading_model');
	   cekLogin();
    }
	
	public function index(){
		$data['acc'] = $this->Acc_trading_model->get_by_id_nasabah($this->session->userdata('cd_id'));
		$this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/perjanjian', $data);
        $this->load->view('templates/footer');
	}

	public function FormulirPBK01()
	{
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$email = $this->session->userdata('nsb_email');
		$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();
		// $data['user'] = array('nama' => "dedi Apudin", 'handphone' => "1029381203", 'tanggal' => "9/07/2019");
        $html =  $this->load->view('kabinet/FormulirPBK01',$data,true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK01.pdf', array("Attachment" => false));
		}

	public function FormulirPBK02_1()
	{
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$email = $this->session->userdata('nsb_email');
		$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();
		// var_dump($data['user']);
		// die();
        $html =  $this->load->view('kabinet/FormulirPBK02_1',$data,true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK02_1.pdf', array("Attachment" => false));
		}
	
	public function FormulirPBK02_2()
	{
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$email = $this->session->userdata('nsb_email');
		$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();
        $html =  $this->load->view('kabinet/FormulirPBK02_2',$data,true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK02_2.pdf', array("Attachment" => false));
		}
	
	public function FormulirPBK03()
	{
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$email = $this->session->userdata('nsb_email');
		$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();
		$id = $this->session->userdata('cd_id');
		$this->load->model('Nasabah_model','nasabah');
		$data['bank'] = $this->nasabah->get_join_bank($id)->row_array();
		// var_dump($data['bank']);
		// die();
        $html =  $this->load->view('kabinet/FormulirPBK03',$data,true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK03.pdf', array("Attachment" => false));
		}
	
	public function FormulirPBK04()
	{
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$email = $this->session->userdata('nsb_email');
		$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();
        $html =  $this->load->view('kabinet/FormulirPBK04',$data,true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK04.pdf', array("Attachment" => false));
		}
	
	public function FormulirPBK05()
	{
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$email = $this->session->userdata('nsb_email');
		$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();
        $html =  $this->load->view('kabinet/FormulirPBK05',$data,true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK05.pdf', array("Attachment" => false));
		}
	
	public function FormulirPBK06()
	{
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$email = $this->session->userdata('nsb_email');
		$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();
        $html =  $this->load->view('kabinet/FormulirPBK06',$data,true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK06.pdf', array("Attachment" => false));
		}
	
	public function FormulirPBK07()
	{
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
		$dompdf = new Dompdf();
		$email = $this->session->userdata('nsb_email');
		$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();
        $html =  $this->load->view('kabinet/FormulirPBK07',$data,true);
		$dompdf->load_html($html);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();
		$pdf = $dompdf->output();
		#Output the generated PDF to Browser
		$dompdf->stream('FormulirPBK07.pdf', array("Attachment" => false));
		}
		


}
 