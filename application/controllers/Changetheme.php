<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Changetheme
 */
class Changetheme extends CI_Controller
{
	/**
	 * ChangeTheme constructor.
	 */
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * change theme
	 * @param integer $theme
	 */
	public function index()
	{
		$theme = $this->input->get('theme');

		if((int) $theme == 1) {
			// set black theme
			$this->db->set('theme', 1);
		} else {
			// set white (default) theme
			$this->db->set('theme', 0);
		}

		if($email = $this->session->userdata('nsb_email'))
		{
			// update theme settings for user profile
			$this->db->where('email', $email);
			$this->db->update('nasabah');

			// update userdata (session)
			$this->session->set_userdata('theme', (int) $theme);
		}

		if(!empty($_SERVER['HTTP_REFERER'])){
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect('kabinet');
		}
	}
}
