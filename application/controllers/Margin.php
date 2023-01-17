<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Margin extends CI_Controller {

	 function __construct() {
	   parent::__construct();
	  	
    }
	
	public function index(){
		$this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/margin');
        $this->load->view('templates/footer');
	}


}
 