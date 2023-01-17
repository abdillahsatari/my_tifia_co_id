<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Education extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cekLogin();
		cekRole('5');
		agreement_check();
		// $this->load->model([]);
	}

	public function index()
	{
		$data['title'] = 'Marketing Digital';

		$data['link'] = $this->get_kit($data['title']);

		$this->viewku->title($data['title']);
		$this->viewku->view("kit/link_download.php", $data);
	}

	public function trading()
	{
		$data['title'] = 'Trading Education';

		$data['link'] = $this->get_kit($data['title']);

		$this->viewku->title($data['title']);
		$this->viewku->view("kit/link_download.php", $data);
	}

	public function sales()
	{
		$data['title'] = 'Sales Education';

		$data['link'] = $this->get_kit($data['title']);

		$this->viewku->title($data['title']);
		$this->viewku->view("kit/link_download.php", $data);
	}

	public function leadership()
	{
		$data['title'] = 'Leadership & Motivation';

		$data['link'] = $this->get_kit($data['title']);

		$this->viewku->title($data['title']);
		$this->viewku->view("kit/link_download.php", $data);
	}


	private function get_kit($jenis = '')
	{
		return $this->db->query("SELECT * FROM marketing_kit WHERE jenis='$jenis'")->result();
	}
}
