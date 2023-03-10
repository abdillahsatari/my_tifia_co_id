<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Marketing_list extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->layout->auth();
        $c_url = $this->router->fetch_class();
        $this->layout->auth_privilege($c_url); 
        $this->load->model('Marketing_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Marketing List';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['code_js'] = 'marketing/codejs';
        $data['page'] = 'marketing/marketing_list';
        $this->load->view('template/backend', $data);
        // print_r($this->Marketing_model->get_all());
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Marketing_model->json();
    }

}

/* End of file marketing.php */
/* Location: ./application/controllers/marketing.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-08 19:45:30 */
/* http://harviacode.com */