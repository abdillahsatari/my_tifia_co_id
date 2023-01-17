<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Download_compro extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Download_compro_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Download Compro';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Download Compro' => '',
        ];
        $data['code_js'] = 'download_compro/codejs';
        $data['page'] = 'download_compro/download_compro_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Download_compro_model->json();
    }

    public function read($id) 
    {
        $row = $this->Download_compro_model->get_by_id($id);
        if ($row) {
            $data = array(
		'download_compro_id' => $row->download_compro_id,
		'nama' => $row->nama,
		'email' => $row->email,
		'date' => $row->date,
	    );
        $data['title'] = 'Download Compro';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'download_compro/download_compro_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('download_compro'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('adminarea/download_compro/create_action'),
	    'download_compro_id' => set_value('download_compro_id'),
	    'nama' => set_value('nama'),
	    'email' => set_value('email'),
	    'date' => set_value('date'),
	);
        $data['title'] = 'Download Compro';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'download_compro/download_compro_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'email' => $this->input->post('email',TRUE),
		'date' => $this->input->post('date',TRUE),
	    );
}$this->Download_compro_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('adminarea/download_compro'));
    }
    
    public function update($id) 
    {
        $row = $this->Download_compro_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('adminarea/download_compro/update_action'),
		'download_compro_id' => set_value('download_compro_id', $row->download_compro_id),
		'nama' => set_value('nama', $row->nama),
		'email' => set_value('email', $row->email),
		'date' => set_value('date', $row->date),
	    );
            $data['title'] = 'Download Compro';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'download_compro/download_compro_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/download_compro'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('download_compro_id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'email' => $this->input->post('email',TRUE),
		'date' => $this->input->post('date',TRUE),
	    );

            $this->Download_compro_model->update($this->input->post('download_compro_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('adminarea/download_compro'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Download_compro_model->get_by_id($id);

        if ($row) {
            $this->Download_compro_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('download_compro'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/download_compro'));
        }
    }

    public function deletebulk(){
        $delete = $this->Download_compro_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('date', 'date', 'trim|required');

	$this->form_validation->set_rules('download_compro_id', 'download_compro_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "download_compro.xls";
        $judul = "download_compro";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Date");

	foreach ($this->Download_compro_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=download_compro.doc");

        $data = array(
            'download_compro_data' => $this->Download_compro_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('download_compro/download_compro_doc',$data);
    }

  public function printdoc(){
        $data = array(
            'download_compro_data' => $this->Download_compro_model->get_all(),
            'start' => 0
        );
        $this->load->view('download_compro/download_compro_print', $data);
    }

}

/* End of file Download_compro.php */
/* Location: ./application/controllers/Download_compro.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-04-23 08:17:27 */
/* http://harviacode.com */