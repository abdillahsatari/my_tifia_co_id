<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
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
    $this->titleku .= setting('WEB_NAME', 'nama', TRUE) . ' | ' . $title;
  }

  public function view($view, $main = '', $headfoot = TRUE)
  {
    $header = [];
    $header['title'] = $this->titleku;
    if ($headfoot == TRUE) {
      $this->CI->load->view('v_header', $header);
      $this->CI->load->view($view, $main);
      $this->CI->load->view('v_footer');
    } else {
      $this->CI->load->view($view, $main);
    }
  }
} 
//end class Template
