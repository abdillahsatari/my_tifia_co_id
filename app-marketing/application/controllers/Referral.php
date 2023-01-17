<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Referral extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->view('templates/header');
    $this->load->view('templates/topbar');
    $this->load->view('templates/sidebar');
    $this->load->view('kabinet/referral');
    $this->load->view('templates/footer');
  }
}
