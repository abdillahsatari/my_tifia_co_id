<?php defined('BASEPATH') or exit('No direct script access allowed');

class Viewku
{
	private $CI;

	private $titleku = '';

	function __construct()
	{
		$this->CI = &get_instance();
	}

	public function title($title = '')
	{
		$this->titleku .= 'PT. Teknologi Finansial Berjangka | ' . $title;
	}

	public function view($view, $main = '', $headfoot = TRUE)
	{
		// $this->CI->load->helper('admin');
		$header = [];
		if ($this->CI->session->userdata('mkt')) {
			$marketing_id = $this->CI->session->userdata('mkt');
			$query = $this->CI->db->query(' SELECT marketing.*
		                                    FROM marketing 
		                                    WHERE  id = "' . $marketing_id . '"');
			$result = $query->row_array();
			$header = [
				'nama' => $result['nama'],
				'kode' => $result['kode'],
				'marketing_id' => $marketing_id
			];
		}
		$header['title'] = $this->titleku;
		if ($headfoot == TRUE) {

			$this->CI->load->view('templates/header', $header);
			$this->CI->load->view('templates/topbar');
			$this->CI->load->view('templates/sidebar');
			$this->CI->load->view($view, $main);
			$this->CI->load->view('templates/footer');
		} else {
			$this->CI->load->view($view, $main);
		}
	}
} 
//end class Template
