<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_email extends CI_Controller {

  /**
  * Kirim email dengan SMTP Gmail.
  *
  */
  public function index() {
    $this->_sendEmail();
  }

  private function _sendEmail() {
    $from_email = 'noreply@cibfx.co.id';

    //configure email settings
	  $config['useragent']      = 'CodeIgniter';
	  $config['protocol']       = 'smtp';
	  $config['smtp_crypto']    = 'tls'; // tls or ssl
	  $config['smtp_host']      = 'mail.tfx.co.id';
	  $config['smtp_user']      = 'support@tifia.co.id';
	  $config['smtp_pass']      = '4r3Z/F9KaM';
	  $config['smtp_port']      = 587;
	  $config['smtp_timeout']   = 20;
	  $config['wordwrap']       = true;
	  $config['wrapchars']      = 76;
	  $config['mailtype']       = 'html';
	  $config['charset']        = 'utf-8';
	  $config['validate']       = false;
	  $config['priority']       = 3;
	  $config['crlf']           = "\r\n";
	  $config['newline']        = "\r\n";
	  $config['bcc_batch_mode'] = false;
	  $config['bcc_batch_size'] = 200;
    
    //$this->load->library('email', $config);
    $this->email->initialize($config);   

    // Load library email dan konfigurasinya
    // $this->email->initialize($config);
    $this->load->library('email', $config);

    // Email dan nama pengirim
	  $this->email->from('support@tifia.co.id', 'PT. Tifia Finansial Berjangka');

    // Email penerima
    $this->email->to('Manager@tifia.co.id'); // Ganti dengan email tujuan kamu

    // Subject email
    $this->email->subject('TEST');

    // $body = $this->load->view('template_email/test', true);

    // Isi email
    $this->email->message($this->getEmailBody());
         
    // $this->email->message('huu');

    // Tampilkan pesan sukses atau error
    if ($this->email->send()) {
      echo "string";
      return true;
    } else {
      echo $this->email->print_debugger();
      die();
    }
  }

  public function getEmailBody() {
      // $data = array('fullname'=>$fullname,'total'=>$total,'tanggal'=>$tanggal,'norek'=>$norek,'nama_bank'=>$nama_bank);
      $msg = $this->load->view('template_email/test', true);;
      return $msg;
  }
}
