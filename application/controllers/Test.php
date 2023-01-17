<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Test
 */
class Test extends CI_Controller
{
	/**
	 * Test constructor.
	 */
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->_sendEmailAdmin();
//		$this->_sendEmail();
	}

	private function _sendEmailAdmin()
	{
		$email = $_GET['email'];

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

		if($email && $email != '') {
			$this->email->initialize($config);
			$this->load->library('email', $config);
			$this->email->from('support@tifia.co.id', 'PT. Tifia Finansial Berjangka');
			$this->email->to($email);
			$this->email->subject('Test mail subject');
			$this->email->message('Test send mail text');

			if($this->email->send()) {
				echo '<strong>email:</strong> ' . $email . '<br>';
				echo '<strong>status email send:</strong> ok <br>';
				var_dump($this->email->print_debugger());
				die();
			} else {
				var_dump($this->email->print_debugger());
				die('status email send: fail');
			}
		} else {
			die('email empty');
		}
	}
}
