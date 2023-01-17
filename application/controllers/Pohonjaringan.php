<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pohonjaringan extends CI_Controller {

	 function __construct() {
	   parent::__construct();
	  	
    }
	
	public function index(){
		$this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/pohonjaringan');
        $this->load->view('templates/footer');
	}


}
 