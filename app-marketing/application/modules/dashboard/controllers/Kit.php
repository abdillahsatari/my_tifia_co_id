<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kit extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole('4');
		agreement_check();
		// $this->load->model([]);
	}

	public function index()
	{
		$this->compro();
	}

	public function compro()
	{
		$data['title'] = 'Company Profile';

		$data['link'] = $this->get_kit($data['title']);

		$this->viewku->title($data['title']);
		$this->viewku->view("kit/link_download.php", $data);
	}

	public function productknowledge()
	{
		$data['title'] = 'Product Knowledge';
		$data['link'] = $this->get_kit($data['title']);

		$this->viewku->title($data['title']);
		$this->viewku->view("kit/link_download.php", $data);
	}

	public function perhitungankomisi()
	{
		$data['title'] = 'Perhitungan Komisi';
		$data['link'] = $this->get_kit($data['title']);

		$this->viewku->title($data['title']);
		$this->viewku->view("kit/simulasi_komisi.php", $data);
	}

	public function videopromosi()
	{
		$data['title'] = 'Video Promosi';
		$data['link'] = $this->get_kit($data['title']);

		$this->viewku->title($data['title']);
		$this->viewku->view("kit/link_download.php", $data);
	}

	private function get_kit($jenis = '')
	{
		return $this->db->query("SELECT * FROM marketing_kit WHERE jenis='$jenis' AND tipe='kit'")->result();
	}
}
