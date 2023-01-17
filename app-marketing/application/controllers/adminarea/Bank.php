<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bank extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model(array('Bank_model', 'Log_model'));
        $this->load->library('form_validation');        
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Bank';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Bank' => '',
        ];
        $data['code_js'] = 'bank/codejs';
        $data['page'] = 'bank/bank_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Bank_model->json();
    }

    public function read($id) 
    {
        $row = $this->Bank_model->get_by_id($id);
        if ($row) {
            $data = array(
		'bank_id' => $row->bank_id,
		'nasabah_id' => $row->nasabah_id,
		'nama_bank' => $row->nama_bank,
		'no_rekening' => $row->no_rekening,
		'cabang' => $row->cabang,
		'jenis_rekening' => $row->jenis_rekening,
		'telepon_bank' => $row->telepon_bank,
		'kode_bank' => $row->kode_bank,
		'atas_nama' => $row->atas_nama,
		'currency' => $row->currency,
		'created_date' => $row->created_date,
		'update_date' => $row->update_date,
		'status_bank' => $row->status_bank,
	    );
        $data['title'] = 'Bank';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'bank/bank_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bank'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('adminarea/bank/create_action'),
    	    'bank_id' => set_value('bank_id'),
    	    'nasabah_id' => set_value('nasabah_id'),
    	    'nama_bank' => set_value('nama_bank'),
    	    'no_rekening' => set_value('no_rekening'),
    	    'cabang' => set_value('cabang'),
    	    'jenis_rekening' => set_value('jenis_rekening'),
    	    'telepon_bank' => set_value('telepon_bank'),
    	    'kode_bank' => set_value('kode_bank'),
    	    'atas_nama' => set_value('atas_nama'),
    	    'currency' => set_value('currency'),
    	    'created_date' => set_value('created_date'),
    	    'update_date' => set_value('update_date'),
    	    'status_bank' => set_value('status_bank'),
    	);
        $data['title'] = 'Bank';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'bank/bank_form';
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
    		'nama_bank' => $this->input->post('nama_bank',TRUE),
    		'no_rekening' => $this->input->post('no_rekening',TRUE),
    		'cabang' => $this->input->post('cabang',TRUE),
    		'jenis_rekening' => $this->input->post('jenis_rekening',TRUE),
    		'telepon_bank' => $this->input->post('telepon_bank',TRUE),
    		'kode_bank' => $this->input->post('kode_bank',TRUE),
    		'atas_nama' => $this->input->post('atas_nama',TRUE),
    		'currency' => $this->input->post('currency',TRUE),
    		'created_date' => $this->input->post('created_date',TRUE),
    		'update_date' => $this->input->post('update_date',TRUE),
    		'status_bank' => $this->input->post('status_bank',TRUE),
    	    );
        }$this->Bank_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('adminarea/bank'));
    }
    
    public function update($id) 
    {
        $row = $this->Bank_model->get_by_id_join_bank($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('adminarea/bank/update_action'),
        		'bank_id' => set_value('bank_id', $row->bank_id),
        		'nasabah_id' => set_value('nasabah_id', $row->nasabah_id),
                'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
        		'nama_bank' => set_value('nama_bank', $row->nama_bank),
        		'no_rekening' => set_value('no_rekening', $row->no_rekening),
        		'cabang' => set_value('cabang', $row->cabang),
        		'jenis_rekening' => set_value('jenis_rekening', $row->jenis_rekening),
        		'telepon_bank' => set_value('telepon_bank', $row->telepon_bank),
        		'kode_bank' => set_value('kode_bank', $row->kode_bank),
        		'atas_nama' => set_value('atas_nama', $row->atas_nama),
        		'currency' => set_value('currency', $row->currency),
        		'created_date' => set_value('created_date', $row->created_date),
        		'update_date' => set_value('update_date', $row->update_date),
        		'status_bank' => set_value('status_bank', $row->status_bank),
                'gambar' => set_value('gambar', $row->gambar),
                'gambar2' => set_value('gambar2', $row->foto_buku_tabungan),
	        );
            $data['title'] = 'Bank';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'bank/bank_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/bank'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('bank_id', TRUE));
        } else {
            $data = array(
        		'update_date' => date('Y-m-d h:i:s'),
        		'status_bank' => $this->input->post('status_bank',TRUE),
	           );

            $this->Bank_model->update($this->input->post('bank_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('adminarea/bank'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Bank_model->get_by_id($id);

        if ($row) {
            $this->Bank_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('adminarea/bank'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/bank'));
        }
    }

    public function deletebulk(){
        $delete = $this->Bank_model->deletebulk();
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
    	$this->form_validation->set_rules('nama_bank', 'nama bank', 'trim|required');
    	$this->form_validation->set_rules('no_rekening', 'no rekening', 'trim|required');
    	$this->form_validation->set_rules('cabang', 'cabang', 'trim');
    	$this->form_validation->set_rules('jenis_rekening', 'jenis rekening', 'trim|required');
    	$this->form_validation->set_rules('telepon_bank', 'telepon bank', 'trim');
    	// $this->form_validation->set_rules('kode_bank', 'kode bank', 'trim|required');
    	$this->form_validation->set_rules('atas_nama', 'atas nama', 'trim|required');
    	$this->form_validation->set_rules('currency', 'currency', 'trim|required');
    	$this->form_validation->set_rules('status_bank', 'status bank', 'trim|required');

    	$this->form_validation->set_rules('bank_id', 'bank_id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "bank.xls";
        $judul = "bank";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nasabah Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Bank");
        xlsWriteLabel($tablehead, $kolomhead++, "No Rekening");
        xlsWriteLabel($tablehead, $kolomhead++, "Cabang");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Rekening");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Bank");
        xlsWriteLabel($tablehead, $kolomhead++, "Atas Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Currency");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Regist");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal verifikasi");
        xlsWriteLabel($tablehead, $kolomhead++, "Status Bank");

	    foreach ($this->Bank_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->nasabah_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_bank);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_rekening);
            xlsWriteLabel($tablebody, $kolombody++, $data->cabang);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_rekening);
            xlsWriteLabel($tablebody, $kolombody++, $data->kode_bank);
            xlsWriteLabel($tablebody, $kolombody++, $data->atas_nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->currency);
            xlsWriteLabel($tablebody, $kolombody++, $data->created_date);
            xlsWriteLabel($tablebody, $kolombody++, $data->update_date);
            xlsWriteLabel($tablebody, $kolombody++, $data->status_bank);

            $tablebody++;
                $nourut++;
        }

        xlsEOF();
        exit();

    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=bank.doc");

        $data = array(
            'bank_data' => $this->Bank_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('bank/bank_doc',$data);
    }

  public function printdoc(){
        $data = array(
            'bank_data' => $this->Bank_model->get_all(),
            'start' => 0
        );
        $this->load->view('bank/bank_print', $data);
    }

}

/* End of file Bank.php */
/* Location: ./application/controllers/Bank.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-14 12:48:11 */
/* http://harviacode.com */