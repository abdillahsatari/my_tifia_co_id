<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acc_currency extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Acc_currency_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Acc Currency';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Acc Currency' => '',
        ];
        $data['code_js'] = 'acc_currency/codejs';
        $data['page'] = 'acc_currency/acc_currency_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Acc_currency_model->json();
    }

    public function read($id) 
    {
        $row = $this->Acc_currency_model->get_by_id($id);
        if ($row) {
            $data = array(
		'acc_currency_id' => $row->acc_currency_id,
		'nama_currency' => $row->nama_currency,
		'deposit_rate' => $row->deposit_rate,
		'withdraw_rate' => $row->withdraw_rate,
		'status_currency' => $row->status_currency,
		'tgl_update_cdeposit' => $row->tgl_update_cdeposit,
		'tgl_update_cwithdraw' => $row->tgl_update_cwithdraw,
	    );
        $data['title'] = 'Acc Currency';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'acc_currency/acc_currency_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('acc_currency'));
        }
    }

   public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('adminarea/acc_currency/create_action'),
            'acc_currency_id' => set_value('acc_currency_id'),
            'nama_currency' => set_value('nama_currency'),
            'deposit_rate' => set_value('deposit_rate'),
            'withdraw_rate' => set_value('withdraw_rate'),
            'status_currency' => set_value('status_currency'),
            'tgl_update_cdeposit' => date("Y-m-d H:i:s"),
            'tgl_update_cwithdraw' => date("Y-m-d H:i:s"),
	    );
        $data['title'] = 'Acc Currency';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'acc_currency/acc_currency_form';
        $this->load->view('template/backend', $data);
    }
    
   public function create_action(){
        $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->create();
        // } 
        // else {
            $data = array(
            'nama_currency' => $this->input->post('nama_currency',TRUE),
            'deposit_rate' => $this->input->post('deposit_rate',TRUE),
            'withdraw_rate' => $this->input->post('withdraw_rate',TRUE),
            'status_currency' => $this->input->post('status_currency',TRUE),
            'tgl_update_cdeposit' => date("Y-m-d H:i:s"),
            'tgl_update_cwithdraw' => date("Y-m-d H:i:s"),
            );
        // }
        $this->Acc_currency_model->insert($data);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect(site_url('adminarea/acc_currency'));
        // print_r($data);
    }
    
    public function update($id) 
    {
        $row = $this->Acc_currency_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('adminarea/acc_currency/update_action'),
                'acc_currency_id' => set_value('acc_currency_id', $row->acc_currency_id),
                'nama_currency' => set_value('nama_currency', $row->nama_currency),
                'deposit_rate' => set_value('deposit_rate', $row->deposit_rate),
                'withdraw_rate' => set_value('withdraw_rate', $row->withdraw_rate),
                'status_currency' => set_value('status_currency', $row->status_currency),
                'tgl_update_cdeposit' => date("Y-m-d H:i:s"),
                'tgl_update_cwithdraw' => date("Y-m-d H:i:s"),
	        );
            $data['title'] = 'Acc Currency';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'acc_currency/acc_currency_form';
            $this->load->view('template/backend', $data);
        } 
        else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/acc_currency'));
        }
    }
    
   public function update_action(){
        $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->update($this->input->post('acc_currency_id', TRUE));
        // }
        // else {
            $data = array(
                'nama_currency' => $this->input->post('nama_currency',TRUE),
                'deposit_rate' => $this->input->post('deposit_rate',TRUE),
                'withdraw_rate' => $this->input->post('withdraw_rate',TRUE),
                'status_currency' => $this->input->post('status_currency',TRUE),
                'tgl_update_cdeposit' => date("Y-m-d H:i:s"),
                'tgl_update_cwithdraw' => date("Y-m-d H:i:s"),
            );

            $this->Acc_currency_model->update($this->input->post('acc_currency_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('adminarea/acc_currency'));
        // }
    }
    
    public function delete($id) 
    {
        $row = $this->Acc_currency_model->get_by_id($id);

        if ($row) {
            $this->Acc_currency_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('adminarea/acc_currency'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/acc_currency'));
        }
    }

    public function deletebulk(){
        $delete = $this->Acc_currency_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nama_currency', 'nama currency', 'trim|required');
	$this->form_validation->set_rules('deposit_rate', 'deposit rate', 'trim|required|numeric');
	$this->form_validation->set_rules('withdraw_rate', 'withdraw rate', 'trim|required|numeric');
	$this->form_validation->set_rules('status_currency', 'status currency', 'trim|required');
	$this->form_validation->set_rules('tgl_update_cdeposit', 'tgl update cdeposit', 'trim|required');
	$this->form_validation->set_rules('tgl_update_cwithdraw', 'tgl update cwithdraw', 'trim|required');

	$this->form_validation->set_rules('acc_currency_id', 'acc_currency_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "acc_currency.xls";
        $judul = "acc_currency";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Currency");
	xlsWriteLabel($tablehead, $kolomhead++, "Deposit Rate");
	xlsWriteLabel($tablehead, $kolomhead++, "Withdraw Rate");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Currency");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Update Cdeposit");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Update Cwithdraw");

	foreach ($this->Acc_currency_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_currency);
	    xlsWriteNumber($tablebody, $kolombody++, $data->deposit_rate);
	    xlsWriteNumber($tablebody, $kolombody++, $data->withdraw_rate);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_currency);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_update_cdeposit);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_update_cwithdraw);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=acc_currency.doc");

        $data = array(
            'acc_currency_data' => $this->Acc_currency_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('acc_currency/acc_currency_doc',$data);
    }

  public function printdoc(){
        $data = array(
            'acc_currency_data' => $this->Acc_currency_model->get_all(),
            'start' => 0
        );
        $this->load->view('acc_currency/acc_currency_print', $data);
    }

}

/* End of file Acc_currency.php */
/* Location: ./application/controllers/Acc_currency.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-17 17:33:42 */
/* http://harviacode.com */