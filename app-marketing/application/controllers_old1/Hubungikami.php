<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hubungikami extends CI_Controller {

	function __construct() {
		parent::__construct();
		cekLogin();
		$this->load->model(array('Nasabah_pesan_model', 'Log_model'));

	}

	public function index(){
		$data['pesan'] = $this->Nasabah_pesan_model->get_by_id_join($this->session->userdata('cd_id'));

		$this->load->view('templates/header');
		$this->load->view('templates/topbar');
		$this->load->view('templates/sidebar');
		$this->load->view('kabinet/hubungikami', $data);
		$this->load->view('templates/footer');
	}

	public function save() {
		$this->form_validation->set_rules('tujuan','Departemen Tujuan','trim|required');
		$this->form_validation->set_rules('subject','Subject','trim|required');
		$this->form_validation->set_rules('isi','Pesan','trim|required');
		$this->form_validation->set_rules('image','Lampiran','callback_upload');

		if ($this->form_validation->run() == FALSE) {
			$data['bank'] = $this->Bank_model->get_by_id_join($this->session->userdata('cd_id'));

			$this->load->view('templates/header');
			$this->load->view('templates/topbar');
			$this->load->view('templates/sidebar');
			$this->load->view('kabinet/bank', $data);
			$this->load->view('templates/footer');
			// redirect('bank');
		} else {
			$jmlPesan = $this->Nasabah_pesan_model->get_count();
			$jmlPesan = $jmlPesan + 1;
			$no_Pesan = 'RTFMSG'.date('Y').date('m').date('d').'000'.$jmlPesan;

			$dataPesan = array(
				'nasabah_pesan_id' => $no_Pesan,
				'nasabah_id' => $this->session->userdata('cd_id'),
				'tujuan' => $this->input->post('tujuan',TRUE),
				'subject' => $this->input->post('subject',TRUE),
				'isi' => $this->input->post('isi',TRUE),
				'lampiran' => $_POST['image'],
				'create_date' => date('Y-m-d h:i:s'),
				'status_pesan' => 'Delivered',
			);
			$this->Nasabah_pesan_model->insert($dataPesan);

			$dataLog = array(
				'nasabah_id' => $this->session->userdata('cd_id'),
				'nasabah_pesan_id' => $no_Pesan,
				'type' => 'Pesan',
				'read_status' => 'N',
				'aktifitas' => 'Mengirim Pesan');
			$this->Log_model->insert($dataLog);

			$this->_sendEmail($dataPesan);

			$this->session->set_flashdata('message',
				'<div class="alert alert-success" role="alert">
													  Pesan terkirim, tunggu approval admin!
													</div>');
			redirect('hubungikami');
		}
	}

	public function upload() {
		$config['upload_path'] = './uploads/lampiran/';
		// $config['max_size'] = 1024 * 10;
		$config['allowed_types'] = '*';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if(isset($_FILES['image']) && !empty($_FILES['image']['name']))
		{
			if($this->upload->do_upload('image'))
			{
				$upload_data = $this->upload->data();
				$_POST['image'] = $upload_data['file_name'];
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('validate_image', $this->upload->display_errors());

				echo $this->upload->display_errors();
				// return FALSE;
				die();
			}
		}
		else
		{
			$_POST['image'] = NULL;
			return TRUE;
		}
	}

	private function _sendEmail($data) {
		// Konfigurasi email
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

		// Load library email dan konfigurasinya
		$this->email->initialize($config);
		$this->load->library('email', $config);

		// Email dan nama pengirim
		$this->email->from('support@tifia.co.id', 'PT. Tifia Finansial Berjangka');

		// Email penerima
		$this->email->to('Manager@tifia.co.id');

		// Subject email
		$this->email->subject('Pesan nasabah : '.$data['subject']);

		// Isi email
		$this->email->message($data['isi']);

		// $this->email->message('huu');

		// Tampilkan pesan sukses atau error
		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die();
		}
	}
}
