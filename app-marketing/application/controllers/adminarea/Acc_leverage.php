<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acc_leverage extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Acc_leverage_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Acc Leverage';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Acc Leverage' => '',
        ];
        $data['code_js'] = 'acc_leverage/codejs';
        $data['page'] = 'acc_leverage/acc_leverage_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Acc_leverage_model->json();
    }

    public function read($id) 
    {
        $row = $this->Acc_leverage_model->get_by_id($id);
        if ($row) {
            $data = array(
		'acc_leverage_id' => $row->acc_leverage_id,
		'leverage' => $row->leverage,
		'nama_leverage' => $row->nama_leverage,
		'status_leverage' => $row->status_leverage,
		'date' => $row->date,
	    );
        $data['title'] = 'Acc Leverage';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'acc_leverage/acc_leverage_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/acc_leverage'));
        }
    }

   public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('adminarea/acc_leverage/create_action'),
            'acc_leverage_id' => set_value('acc_leverage_id'),
            'leverage' => set_value('leverage'),
            'nama_leverage' => set_value('nama_leverage'),
            'status_leverage' => set_value('status_leverage'),
            'date' => date("Y-m-d H:i:s")
	    );
        $data['title'] = 'Acc Leverage';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'acc_leverage/acc_leverage_form';
        $this->load->view('template/backend', $data);
    }
    
   public function create_action() 
    {
        $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } else {
            $data = array(
                'leverage' => $this->input->post('leverage',TRUE),
                'nama_leverage' => $this->input->post('nama_leverage',TRUE),
                'status_leverage' => $this->input->post('status_leverage',TRUE)
	        );
        //  }
        $this->Acc_leverage_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('adminarea/acc_leverage'));
    }
   public function update($id) 
    {
        $row = $this->Acc_leverage_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('adminarea/acc_leverage/update_action'),
                'acc_leverage_id' => set_value('acc_leverage_id', $row->acc_leverage_id),
                'leverage' => set_value('leverage', $row->leverage),
                'nama_leverage' => set_value('nama_leverage', $row->nama_leverage),
                'status_leverage' => set_value('status_leverage', $row->status_leverage),
                'date' =>  date("Y-m-d H:i:s"),
	         );
            $data['title'] = 'Acc Leverage';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

        $data['page'] = 'acc_leverage/acc_leverage_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/acc_leverage'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('acc_leverage_id', TRUE));
        // } else {
            $data = array(
                'leverage' => $this->input->post('leverage',TRUE),
                'nama_leverage' => $this->input->post('nama_leverage',TRUE),
                'status_leverage' => $this->input->post('status_leverage',TRUE),
                'date' =>  date("Y-m-d H:i:s"),
            );

            $this->Acc_leverage_model->update($this->input->post('acc_leverage_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('adminarea/acc_leverage'));
        // }
    }
    
    public function delete($id) 
    {
        $row = $this->Acc_leverage_model->get_by_id($id);

        if ($row) {
            $this->Acc_leverage_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('adminarea/acc_leverage'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/acc_leverage'));
        }
    }

    public function deletebulk(){
        $delete = $this->Acc_leverage_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('leverage', 'leverage', 'trim|required');
	$this->form_validation->set_rules('nama_leverage', 'nama leverage', 'trim|required');
	$this->form_validation->set_rules('status_leverage', 'status leverage', 'trim|required');
	$this->form_validation->set_rules('date', 'date', 'trim|required');

	$this->form_validation->set_rules('acc_leverage_id', 'acc_leverage_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "acc_leverage.xls";
        $judul = "acc_leverage";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Leverage");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Leverage");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Leverage");
	xlsWriteLabel($tablehead, $kolomhead++, "Date");

	foreach ($this->Acc_leverage_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->leverage);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_leverage);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_leverage);
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
        header("Content-Disposition: attachment;Filename=acc_leverage.doc");

        $data = array(
            'acc_leverage_data' => $this->Acc_leverage_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('acc_leverage/acc_leverage_doc',$data);
    }

  public function printdoc(){
        $data = array(
            'acc_leverage_data' => $this->Acc_leverage_model->get_all(),
            'start' => 0
        );
        $this->load->view('acc_leverage/acc_leverage_print', $data);
    }

}

/* End of file Acc_leverage.php */
/* Location: ./application/controllers/Acc_leverage.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-18 18:26:43 */
/* http://harviacode.com */