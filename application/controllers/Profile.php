<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	 function __construct() {
	    parent::__construct();
	  	$this->load->model('Nasabah_model');
    }
	
	public function index(){
		$data['title'] = "My Profile";
		$email = $this->session->userdata('nsb_email');
		$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();
		$id = $this->session->userdata('cd_id');
		$this->load->model('Nasabah_model','nasabah');
		$data['bank'] = $this->nasabah->get_join_bank($id);
		$this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/profile', $data);
        $this->load->view('templates/footer');
	}

	public function updateprofile()
	{
			$email = $this->session->userdata('nsb_email');
			$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();

			// cek jika ada gambar yang di upload
			$upload_image = $_FILES['image']['name'];
			if ($upload_image) {
				$config['upload_path']   = './uploads/photo/';
				$config['allowed_types'] = 'gif|jpg|png|JPG|PNG';
				$config['max_size']      = '2024'; //IMb 
				$config['max_width']     = '2024';
				$config['max_height']    = '1768';

				$this->load->library('upload', $config);
				if ($this->upload->do_upload('image')) {
					#cek apakah gambar nya sama
					$data['user']  = $this->db->get_where('nasabah', array('email' => $email))->row_array();
					$old_image = $data['user']['foto_terkini'];
					if ($old_image != 'default.jpg') {
						#frontcontroller PCPATH 
						// seharusnya ketika ter upload photo lama di hapus dari direktori
						 unlink(FCPATH . 'uploads/photo/' . $old_image);
					}

					# cek jika upload berhasil
					$new_image = $this->upload->data('file_name');
                    $this->db->set('foto_terkini', $new_image);
                    $this->db->where('email', $email);
					$this->db->update('nasabah');
					$this->session->set_userdata('nsb_photo', $new_image);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
														  Photo profile berhasil diupdate!
														</div>');
					redirect('profile');
				}else{
					#tampilkan pesan error jika gagal
					$this->upload->display_errors();
				}

			}	
	}


}
 