<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Users_pesan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$c_url = $this->router->fetch_class();
		$this->layout->auth();
		$this->layout->auth_privilege($c_url);
		$this->load->model('Users_pesan_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}

	public function index()
	{
		$data['title'] = 'Users Pesan';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Users Pesan' => '',
		];
		$data['code_js'] = 'users_pesan/codejs';
		$data['page'] = 'users_pesan/users_pesan_list';
		$this->load->view('template/backend', $data);
	}

	public function json() {
		header('Content-Type: application/json');
		echo $this->Users_pesan_model->json();
	}

	public function read($id)
	{
		$row = $this->Users_pesan_model->get_by_id_join($id);
		if ($row) {
			$data = array(
				'users_pesan_id' => $row->users_pesan_id,
				'nasabah_id' => $row->nasabah_id,
				'nama' => $row->nama_lengkap,
				'email' => $row->emailnasabah,
				'subject' => $row->subject,
				'isi' => $row->isi,
				'lampiran' => $row->lampiran,
				'date' => $row->date,
				'username' => $row->username,
			);
			$data['title'] = 'Users Pesan';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			$data['page'] = 'users_pesan/users_pesan_read';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('users_pesan'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'action' => site_url('adminarea/users_pesan/create_action'),
			'users_pesan_id' => set_value('users_pesan_id'),
			'nasabah_id' => set_value('nasabah_id'),
			'subject' => set_value('subject'),
			'isi' => set_value('isi'),
			'lampiran' => set_value('lampiran'),
			'date' => set_value('date'),
			'user_id' => set_value('user_id'),
		);
		$data['title'] = 'Users Pesan';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Dashboard' => '',
		];

		$data['page'] = 'users_pesan/users_pesan_form';
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
				'subject' => $this->input->post('subject',TRUE),
				'isi' => $this->input->post('isi',TRUE),
				'lampiran' => $this->input->post('lampiran',TRUE),
				'date' => $this->input->post('date',TRUE),
				'user_id' => $this->input->post('user_id',TRUE),
			);
		}
		$this->Users_pesan_model->insert($data);
		$this->session->set_flashdata('message', 'Create Record Success');
		redirect(site_url('adminarea/users_pesan'));
	}

	public function update($id)
	{
		$row = $this->Users_pesan_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('adminarea/users_pesan/update_action'),
				'users_pesan_id' => set_value('users_pesan_id', $row->users_pesan_id),
				'nasabah_id' => set_value('nasabah_id', $row->nasabah_id),
				'subject' => set_value('subject', $row->subject),
				'isi' => set_value('isi', $row->isi),
				'lampiran' => set_value('lampiran', $row->lampiran),
				'date' => set_value('date', $row->date),
				'user_id' => set_value('user_id', $row->user_id),
			);
			$data['title'] = 'Users Pesan';
			$data['subtitle'] = '';
			$data['crumb'] = [
				'Dashboard' => '',
			];

			$data['page'] = 'users_pesan/users_pesan_form';
			$this->load->view('template/backend', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/users_pesan'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('users_pesan_id', TRUE));
		} else {
			$data = array(
				'nasabah_id' => $this->input->post('nasabah_id',TRUE),
				'subject' => $this->input->post('subject',TRUE),
				'isi' => $this->input->post('isi',TRUE),
				'lampiran' => $this->input->post('lampiran',TRUE),
				'date' => $this->input->post('date',TRUE),
				'user_id' => $this->input->post('user_id',TRUE),
			);

			$this->Users_pesan_model->update($this->input->post('users_pesan_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('adminarea/users_pesan'));
		}
	}

	public function delete($id)
	{
		$row = $this->Users_pesan_model->get_by_id($id);

		if ($row) {
			$this->Users_pesan_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('adminarea/users_pesan'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('adminarea/users_pesan'));
		}
	}

	public function deletebulk(){
		$delete = $this->Users_pesan_model->deletebulk();
		if($delete){
			$this->session->set_flashdata('message', 'Delete Record Success');
		}else{
			$this->session->set_flashdata('message_error', 'Delete Record failed');
		}
		echo $delete;
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nasabah_id', 'nasabah id', 'trim|required');
		$this->form_validation->set_rules('subject', 'subject', 'trim|required');
		$this->form_validation->set_rules('isi', 'isi', 'trim|required');
		$this->form_validation->set_rules('lampiran', 'lampiran', 'trim|required');
		$this->form_validation->set_rules('date', 'date', 'trim|required');
		$this->form_validation->set_rules('user_id', 'user id', 'trim|required');

		$this->form_validation->set_rules('users_pesan_id', 'users_pesan_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel()
	{
		$this->load->helper('exportexcel');
		$namaFile = "users_pesan.xls";
		$judul = "users_pesan";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Nasabah");
		xlsWriteLabel($tablehead, $kolomhead++, "Email");
		xlsWriteLabel($tablehead, $kolomhead++, "Subject");
		xlsWriteLabel($tablehead, $kolomhead++, "Isi");
		xlsWriteLabel($tablehead, $kolomhead++, "Date");
		xlsWriteLabel($tablehead, $kolomhead++, "Admin");

		foreach ($this->Users_pesan_model->get_all_join() as $data) {
			$kolombody = 0;

			//ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
			xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
			xlsWriteLabel($tablebody, $kolombody++, $data->emailnasabah);
			xlsWriteLabel($tablebody, $kolombody++, $data->subject);
			xlsWriteLabel($tablebody, $kolombody++, $data->isi);
			xlsWriteLabel($tablebody, $kolombody++, $data->date);
			xlsWriteLabel($tablebody, $kolombody++, $data->username);

			$tablebody++;
			$nourut++;
		}

		xlsEOF();
		exit();
	}

	public function word()
	{
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=users_pesan.doc");

		$data = array(
			'users_pesan_data' => $this->Users_pesan_model->get_all_join(),
			'start' => 0
		);

		$this->load->view('users_pesan/users_pesan_doc',$data);
	}

	public function printdoc(){
		$data = array(
			'users_pesan_data' => $this->Users_pesan_model->get_all_join(),
			'start' => 0
		);
		$this->load->view('users_pesan/users_pesan_print', $data);
	}

}
