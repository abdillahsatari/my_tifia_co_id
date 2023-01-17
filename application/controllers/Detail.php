<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Blog_model');
        $this->load->helper('permalink_helper');
    }

    public function index() {


        $kode='';
        if($this->uri->segment(2) == FALSE) {
            $kode='';
        } else {
            $kode = $this->uri->segment(2);
        }
        $p_kode = explode("-", $kode);
      
        $data['isi']       = $this->Blog_model->get_all('blog_id', $p_kode[0]);
        $data['contentblog'] = $this->Blog_model->get_all_query();
        
        $this->load->view('pages/templateweb/header');
        $this->load->view('pages/detail', $data);
        $this->load->view('pages/templateweb/footer');
    }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Detail.php */