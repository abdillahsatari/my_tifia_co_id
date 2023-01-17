<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Class Nasabah_pesan
 */
class Nasabah_pesan extends CI_Controller
{
	/**
	 * Nasabah_pesan constructor.
	 */
	function __construct()
	{
		parent::__construct();

		$c_url = $this->router->fetch_class();

		$this->layout->auth();
		$this->layout->auth_privilege($c_url);

		$this->load->model('Nasabah_pesan_model');
		$this->load->model('Users_pesan_model');
		$this->load->model('Log_model');

		$this->load->library('form_validation');
		$this->load->library('datatables');
	}

	public function index()
	{
		$data['title'] = 'Nasabah Pesan';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Nasabah Pesan' => '',
		];
		$data['code_js'] = 'nasabah_pesan/codejs';
		$data['page'] = 'nasabah_pesan/nasabah_pesan_list';

		$this->load->view('template/backend', $data);
	}

	public function json()
	{
		header('Content-Type: application/json');

		echo $this->Nasabah_pesan_model->json();
	}

	/**
	 * @param $id
	 */
	public function read($id)
	{
		$row = $this->Nasabah_pesan_model->get_one_by_id_join($id);
		if ($row) {
			$data = array(
				'nasabah_pesan_id' => $row->nasabah_pesan_id,
				'nasabah_id' => $row->nasabah_id,
				'nama_lengkap' => $row->nama_lengkap,
				'email' => $row->email,
				'nasabah_id' => $row->nasabah_id,
				'tujuan' => $row->tujuan,
				'subject' => $row->subject,
				'isi' => $row->isi,
				'lampiran' => $row->lampiran,
				'status' => $row->status,
				'create_date' => $row->create_date,
				'update_date' => $row->update_date,
				'user_id' => $row->user_id,
			);
			$data['title'] = 'Nasabah Pesan';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			$data['page'] = 'nasabah_pesan/nasabah_pesan_read';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('nasabah_pesan'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('adminarea/nasabah_pesan/create_action'),
			'nasabah_pesan_id' => set_value('nasabah_pesan_id'),
			'nasabah_id' => set_value('nasabah_id'),
			'tujuan' => set_value('tujuan'),
			'subject' => set_value('subject'),
			'isi' => set_value('isi'),
			'gambar' => set_value('gambar'),
			'status' => set_value('status'),
			'create_date' => set_value('create_date'),
			'update_date' => set_value('update_date'),
			'user_id' => set_value('user_id'),
		);
		$data['title'] = 'Nasabah Pesan';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Dashboard' => '',
		];

		$data['page'] = 'nasabah_pesan/nasabah_pesan_form';
		$this->load->view('template/backend', $data);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'nasabah_id' => $this->input->post('nasabah_id',TRUE),
				'tujuan' => $this->input->post('tujuan',TRUE),
				'subject' => $this->input->post('subject',TRUE),
				'isi' => $this->input->post('isi',TRUE),
				'gambar' => $this->input->post('gambar',TRUE),
				'status' => $this->input->post('status',TRUE),
				'create_date' => $this->input->post('create_date',TRUE),
				'update_date' => $this->input->post('update_date',TRUE),
				'user_id' => $this->input->post('user_id',TRUE),
			);
		}
		$this->Nasabah_pesan_model->insert($data);
		$this->session->set_flashdata('message', 'Create Record Success');
		redirect(site_url('adminarea/nasabah_pesan'));
	}

	public function update($id)
	{
		$row = $this->Nasabah_pesan_model->get_one_by_id_join($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('adminarea/nasabah_pesan/update_action'),
				'nasabah_pesan_id' => set_value('nasabah_pesan_id', $row->nasabah_pesan_id),
				'nasabah_id' => set_value('nasabah_id', $row->nasabah_id),
				'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
				'email' => set_value('nama_lengkap', $row->email),
				'tujuan' => set_value('tujuan', $row->tujuan),
				'subject' => set_value('subject', $row->subject),
				'isi' => set_value('isi', $row->isi),
				'lampiran' => set_value('lampiran', $row->lampiran),
				'status' => set_value('status', $row->status),
				'create_date' => set_value('create_date', $row->create_date),
				'update_date' => set_value('update_date', $row->update_date),
				'user_id' => set_value('user_id', $row->user_id),
			);
			$data['title'] = 'Nasabah Pesan';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			$data['page'] = 'nasabah_pesan/nasabah_pesan_form';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/nasabah_pesan'));
		}
	}

	public function update_action()
	{
		$user = $this->ion_auth->user()->row();
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('nasabah_pesan_id', TRUE));
		} else {
			//1. update status pesan
			$data = array(
				'status_pesan' => $this->input->post('status_pesan',TRUE),
				'update_date' => date('Y-m-d h:i:s'),
			);
			$this->Nasabah_pesan_model->update($this->input->post('nasabah_pesan_id', TRUE), $data);
			//2. kirim email
			$subject = "Pesan telah ".$this->input->post('status_pesan',TRUE);
			$isi = "Pesan anda dengan nomor ".$this->input->post('nasabah_pesan_id', TRUE)." telah ".$this->input->post('status_pesan',TRUE).".";

			$this->_sendEmail($this->input->post('email',TRUE), $subject, $isi);
			//3. masukin ke tabel users pesan
			$dataEmail = array(
				'nasabah_id' => $this->input->post('nasabah_id',TRUE),
				'subject' => $subject,
				'isi' => $isi,
				'user_id' => $user->id
			);
			$this->Users_pesan_model->insert($dataEmail);
			//4. masuk ke tabel log
			$dataLog = array(
				'user_id' => $user->id,
				'nasabah_id' => $this->input->post('nasabah_id',TRUE),
				'nasabah_pesan_id' => $this->input->post('nasabah_pesan_id', TRUE),
				'type' => 'Pesan',
				'read_status' => 'Y',
				'aktifitas' => 'Ubah status pesan masuk dari nasabah'
			);
			$this->Log_model->insert_admin($dataLog);
			//5. lempar ke halaman nasabah pesan
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('adminarea/nasabah_pesan'));
		}
	}

	private function _sendEmail($email, $subject, $pesan)
	{
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
		$this->email->to($email); // Ganti dengan email tujuan kamu

		// Subject email
		$this->email->subject($subject);

		// Isi email
		$this->email->message($pesan);

		// $this->email->message('huu');

		// Tampilkan pesan sukses atau error
		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die();
		}
	}

	public function delete($id)
	{
		$row = $this->Nasabah_pesan_model->get_by_id($id);

		if ($row) {
			$this->Nasabah_pesan_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('adminarea/nasabah_pesan'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/nasabah_pesan'));
		}
	}

	public function deletebulk()
	{
		$delete = $this->Nasabah_pesan_model->deletebulk();
		if($delete){
			$this->session->set_flashdata('message', 'Delete Record Success');
		} else{
			$this->session->set_flashdata('message_error', 'Delete Record failed');
		}

		echo $delete;
	}

	public function _rules()
	{
		$this->form_validation->set_rules('status_pesan', 'status', 'trim|required');

		$this->form_validation->set_rules('nasabah_pesan_id', 'nasabah_pesan_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "nasabah_pesan.xls";
		$judul = "nasabah_pesan";
		$tablehead = 0;
		$tablebody = 1;
		$nourut = 1;
		//penulisan header
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=" . $namaFile . "");
		header("Content-Transfer-Encoding: binary ");

		xlsBOF();

		$kolomhead = 0;
		xlsWriteLabel($tablehead, $kolomhead++, "No");
		xlsWriteLabel($tablehead, $kolomhead++, "No Pesan");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama");
		xlsWriteLabel($tablehead, $kolomhead++, "Email");
		xlsWriteLabel($tablehead, $kolomhead++, "Tujuan");
		xlsWriteLabel($tablehead, $kolomhead++, "Subject");
		xlsWriteLabel($tablehead, $kolomhead++, "Isi");
		xlsWriteLabel($tablehead, $kolomhead++, "Status");
		xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Kirim");

		foreach ($this->Nasabah_pesan_model->get_all_join() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteNumber($tablebody, $kolombody++, $data->nasabah_pesan_id);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
			xlsWriteLabel($tablebody, $kolombody++, $data->email);
			xlsWriteLabel($tablebody, $kolombody++, $data->tujuan);
			xlsWriteLabel($tablebody, $kolombody++, $data->subject);
			xlsWriteLabel($tablebody, $kolombody++, $data->isi);
			xlsWriteLabel($tablebody, $kolombody++, $data->status);
			xlsWriteLabel($tablebody, $kolombody++, $data->create_date);

			$tablebody++;
			$nourut++;
		}

		xlsEOF();
		exit();
	}

	public function word()
	{
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=nasabah_pesan.doc");

		$data = array(
			'nasabah_pesan_data' => $this->Nasabah_pesan_model->get_all_join(),
			'start' => 0
		);

		$this->load->view('nasabah_pesan/nasabah_pesan_doc',$data);
	}

	public function printdoc()
	{
		$data = array(
			'nasabah_pesan_data' => $this->Nasabah_pesan_model->get_all_join(),
			'start' => 0
		);
		$this->load->view('nasabah_pesan/nasabah_pesan_print', $data);
	}

}
