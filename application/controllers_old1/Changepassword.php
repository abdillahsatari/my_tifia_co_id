<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Changepassword
 */
class Changepassword extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
		$this->form_validation->set_rules('new_password1', 'New Password', 'trim|required|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Retype Password', 'trim|required|min_length[3]|matches[new_password1]');

		if ($this->form_validation->run() == FALSE) {
			# code...
			$data['title'] = "Change Password";
			$email = $this->session->userdata('nsb_email');
			$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();

			$this->load->view('templates/header');
	        $this->load->view('templates/topbar');
	        $this->load->view('templates/sidebar');
	        $this->load->view('kabinet/changepassword');
	        $this->load->view('templates/footer');
		} else {
			# tangkap isian current password
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			$email = $this->session->userdata('nsb_email');
			$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();

			if (!password_verify($current_password, $data['user']['password']))
			{
				#  tampilkan pesan jika current password sama dengan password yang ada di tabel
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama anda salah!</div>');
				redirect('changepassword');
			} else {
				
				# enkripsi inputan new password dengan password hash
				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
				
				# update password baru ke tabel user
				$this->db->set('password',$password_hash);
				$this->db->where('email', $email);
				$this->db->update('nasabah');

				# tampilkan pesan jika berhasil
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Mengganti Password!</div>');

				redirect('changepassword');
			}
		}

		
	}


}
