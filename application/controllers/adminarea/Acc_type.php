<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acc_type extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Acc_type_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Acc Type';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Acc Type' => '',
        ];
        $data['code_js'] = 'acc_type/codejs';
        $data['page'] = 'acc_type/acc_type_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Acc_type_model->json();
    }

    public function read($id) 
    {
        $row = $this->Acc_type_model->get_by_id($id);
        if ($row) {
            $data = array(
		'acc_type_id' => $row->acc_type_id,
		'type' => $row->type,
		'status_type' => $row->status_type,
		'date' => $row->date,
	    );
        $data['title'] = 'Acc Type';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'acc_type/acc_type_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('acc_type'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('adminarea/acc_type/create_action'),
            'acc_type_id' => set_value('acc_type_id'),
            'type' => set_value('type'),
            'status_type' => set_value('status_type'),
            'date' => set_value('date'),
	);
        $data['title'] = 'Acc Type';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'acc_type/acc_type_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
           
        // }
        $data = array(
            'type' => $this->input->post('type',TRUE),
            'status_type' => $this->input->post('status_type', TRUE),
            'date' =>  date("Y-m-d H:i:s")
        );
        $this->Acc_type_model->insert($data);
        $this->session->set_flashdata('message', 'Create Record Success');
       
      
        redirect(site_url('adminarea/acc_type'));
    }
    
   public function update($id) 
    {
        $row = $this->Acc_type_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('adminarea/acc_type/update_action'),
                'acc_type_id' => set_value('acc_type_id', $row->acc_type_id),
                'type' => set_value('type', $row->type),
                'status_type' => set_value('status_type', $row->status_type)
	    );
            $data['title'] = 'Acc Type';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

        $data['page'] = 'acc_type/acc_type_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/acc_type'));
        }
        // print_r($row->status_type);
    }
    
     public function update_action() 
    {
        $this->_rules();
        $data = array(
            'type' => $this->input->post('type',TRUE),
            'status_type' => $this->input->post('status_type', TRUE),
        );
        $this->Acc_type_model->update($this->input->post('acc_type_id', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('adminarea/acc_type'));
       
    }
    
    public function delete($id) 
    {
        $row = $this->Acc_type_model->get_by_id($id);

        if ($row) {
            $this->Acc_type_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('adminarea/acc_type'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/acc_type'));
        }
    }

    public function deletebulk(){
        $delete = $this->Acc_type_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('type', 'type', 'trim|required');
	$this->form_validation->set_rules('status_type', 'status type', 'trim|required');
	$this->form_validation->set_rules('date', 'date', 'trim|required');

	$this->form_validation->set_rules('acc_type_id', 'acc_type_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "acc_type.xls";
        $judul = "acc_type";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Type");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Type");
	xlsWriteLabel($tablehead, $kolomhead++, "Date");

	foreach ($this->Acc_type_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->type);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_type);
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
        header("Content-Disposition: attachment;Filename=acc_type.doc");

        $data = array(
            'acc_type_data' => $this->Acc_type_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('acc_type/acc_type_doc',$data);
    }

  public function printdoc(){
        $data = array(
            'acc_type_data' => $this->Acc_type_model->get_all(),
            'start' => 0
        );
        $this->load->view('acc_type/acc_type_print', $data);
    }

}

/* End of file Acc_type.php */
/* Location: ./application/controllers/Acc_type.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-18 18:24:58 */
/* http://harviacode.com */