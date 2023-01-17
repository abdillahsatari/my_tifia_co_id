<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acc_trading extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Acc_trading_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Acc Trading';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Acc Trading' => '',
        ];
        $data['code_js'] = 'acc_trading/codejs';
        $data['page'] = 'acc_trading/acc_trading_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Acc_trading_model->json();
    }

    public function read($id) 
    {
        $row = $this->Acc_trading_model->get_by_id_noakun_join($id);
        if ($row) {
            $data = array(
        		'no_akun' => $row->no_akun,
                'nama_lengkap' => $row->nama_lengkap,
                'email' => $row->email,
                'type' => $row->type,
                'currency' => $row->nama_currency,
                'leverage' => $row->leverage,
        		'komisi' => $row->komisi,
        		'password_trade' => $row->password_trade,
        		'password_investor' => $row->password_investor,
        		'ip' => $row->ip,
        		'port' => $row->port,
        		'tanggal_buat_akun' => $row->tanggal_buat_akun,
        		'status_aktif' => $row->status_aktif,
                'balance' => $row->balance,
	        );
            $data['title'] = 'Acc Trading';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'acc_trading/acc_trading_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('acc_trading'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('adminarea/acc_trading/create_action'),
    	    'no_akun' => set_value('no_akun'),
    	    'acc_currency_id' => set_value('acc_currency_id'),
    	    'acc_leverage_id' => set_value('acc_leverage_id'),
    	    'nasabah_id' => set_value('nasabah_id'),
    	    'acc_type_id' => set_value('acc_type_id'),
    	    'komisi' => set_value('komisi'),
    	    'percent_req' => set_value('percent_req'),
    	    'password_trade' => set_value('password_trade'),
    	    'password_investor' => set_value('password_investor'),
    	    'ip' => set_value('ip'),
    	    'port' => set_value('port'),
    	    'tanggal_buat_akun' => set_value('tanggal_buat_akun'),
    	    'tanggal_terakhir_login' => set_value('tanggal_terakhir_login'),
    	    'status_aktif' => set_value('status_aktif'),
    	    'user_id' => set_value('user_id'),
    	    'balance' => set_value('balance'),
    	);
        $data['title'] = 'Acc Trading';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'acc_trading/acc_trading_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
    		'acc_currency_id' => $this->input->post('acc_currency_id',TRUE),
    		'acc_leverage_id' => $this->input->post('acc_leverage_id',TRUE),
    		'nasabah_id' => $this->input->post('nasabah_id',TRUE),
    		'acc_type_id' => $this->input->post('acc_type_id',TRUE),
    		'komisi' => $this->input->post('komisi',TRUE),
    		'percent_req' => $this->input->post('percent_req',TRUE),
    		'password_trade' => $this->input->post('password_trade',TRUE),
    		'password_investor' => $this->input->post('password_investor',TRUE),
    		'ip' => $this->input->post('ip',TRUE),
    		'port' => $this->input->post('port',TRUE),
    		'tanggal_buat_akun' => $this->input->post('tanggal_buat_akun',TRUE),
    		'tanggal_terakhir_login' => $this->input->post('tanggal_terakhir_login',TRUE),
    		'status_aktif' => $this->input->post('status_aktif',TRUE),
    		'user_id' => $this->input->post('user_id',TRUE),
    		'balance' => $this->input->post('balance',TRUE),
    	    );
        }$this->Acc_trading_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('adminarea/acc_trading'));
    }
    
    public function update($id) 
    {
        $row = $this->Acc_trading_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('adminarea/acc_trading/update_action'),
		'no_akun' => set_value('no_akun', $row->no_akun),
		'acc_currency_id' => set_value('acc_currency_id', $row->acc_currency_id),
		'acc_leverage_id' => set_value('acc_leverage_id', $row->acc_leverage_id),
		'nasabah_id' => set_value('nasabah_id', $row->nasabah_id),
		'acc_type_id' => set_value('acc_type_id', $row->acc_type_id),
		'komisi' => set_value('komisi', $row->komisi),
		'percent_req' => set_value('percent_req', $row->percent_req),
		'password_trade' => set_value('password_trade', $row->password_trade),
		'password_investor' => set_value('password_investor', $row->password_investor),
		'ip' => set_value('ip', $row->ip),
		'port' => set_value('port', $row->port),
		'tanggal_buat_akun' => set_value('tanggal_buat_akun', $row->tanggal_buat_akun),
		'tanggal_terakhir_login' => set_value('tanggal_terakhir_login', $row->tanggal_terakhir_login),
		'status_aktif' => set_value('status_aktif', $row->status_aktif),
		'user_id' => set_value('user_id', $row->user_id),
		'balance' => set_value('balance', $row->balance),
	    );
            $data['title'] = 'Acc Trading';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'acc_trading/acc_trading_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/acc_trading'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no_akun', TRUE));
        } else {
            $data = array(
		'acc_currency_id' => $this->input->post('acc_currency_id',TRUE),
		'acc_leverage_id' => $this->input->post('acc_leverage_id',TRUE),
		'nasabah_id' => $this->input->post('nasabah_id',TRUE),
		'acc_type_id' => $this->input->post('acc_type_id',TRUE),
		'komisi' => $this->input->post('komisi',TRUE),
		'percent_req' => $this->input->post('percent_req',TRUE),
		'password_trade' => $this->input->post('password_trade',TRUE),
		'password_investor' => $this->input->post('password_investor',TRUE),
		'ip' => $this->input->post('ip',TRUE),
		'port' => $this->input->post('port',TRUE),
		'tanggal_buat_akun' => $this->input->post('tanggal_buat_akun',TRUE),
		'tanggal_terakhir_login' => $this->input->post('tanggal_terakhir_login',TRUE),
		'status_aktif' => $this->input->post('status_aktif',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
		'balance' => $this->input->post('balance',TRUE),
	    );

            $this->Acc_trading_model->update($this->input->post('no_akun', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('adminarea/acc_trading'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Acc_trading_model->get_by_id($id);

        if ($row) {
            $this->Acc_trading_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('adminarea/acc_trading'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/acc_trading'));
        }
    }

    public function deletebulk(){
        $delete = $this->Acc_trading_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
    	$this->form_validation->set_rules('acc_currency_id', 'acc currency id', 'trim|required');
    	$this->form_validation->set_rules('acc_leverage_id', 'acc leverage id', 'trim|required');
    	$this->form_validation->set_rules('nasabah_id', 'nasabah id', 'trim|required');
    	$this->form_validation->set_rules('acc_type_id', 'acc type id', 'trim|required');
    	$this->form_validation->set_rules('komisi', 'komisi', 'trim|required');
    	$this->form_validation->set_rules('percent_req', 'percent req', 'trim|required');
    	$this->form_validation->set_rules('password_trade', 'password trade', 'trim|required');
    	$this->form_validation->set_rules('password_investor', 'password investor', 'trim|required');
    	$this->form_validation->set_rules('ip', 'ip', 'trim|required');
    	$this->form_validation->set_rules('port', 'port', 'trim|required');
    	$this->form_validation->set_rules('tanggal_buat_akun', 'tanggal buat akun', 'trim|required');
    	$this->form_validation->set_rules('tanggal_terakhir_login', 'tanggal terakhir login', 'trim|required');
    	$this->form_validation->set_rules('status_aktif', 'status aktif', 'trim|required');
    	$this->form_validation->set_rules('user_id', 'user id', 'trim|required');
    	$this->form_validation->set_rules('balance', 'balance', 'trim|required|numeric');

    	$this->form_validation->set_rules('no_akun', 'no_akun', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "acc_trading.xls";
        $judul = "acc_trading";
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
        xlsWriteLabel($tablehead, $kolomhead++, "No Akun");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Nasabah");
        xlsWriteLabel($tablehead, $kolomhead++, "Email Nasabah");
        xlsWriteLabel($tablehead, $kolomhead++, "Tipe Akun");
        xlsWriteLabel($tablehead, $kolomhead++, "Nilai Tukar");
        xlsWriteLabel($tablehead, $kolomhead++, "Leverage");
    	xlsWriteLabel($tablehead, $kolomhead++, "Komisi");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Buat Akun");
    	xlsWriteLabel($tablehead, $kolomhead++, "Status Aktif");

	   foreach ($this->Acc_trading_model->get_all_join() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->no_akun);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
            xlsWriteLabel($tablebody, $kolombody++, $data->email);
            xlsWriteLabel($tablebody, $kolombody++, $data->type);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_currency);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_leverage);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->komisi);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_buat_akun);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->status_aktif);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=acc_trading.doc");

        $data = array(
            'acc_trading_data' => $this->Acc_trading_model->get_all_join(),
            'start' => 0
        );
        
        $this->load->view('acc_trading/acc_trading_doc',$data);
    }

  public function printdoc(){
        $data = array(
            'acc_trading_data' => $this->Acc_trading_model->get_all_join(),
            'start' => 0
        );
        $this->load->view('acc_trading/acc_trading_print', $data);
    }

}

/* End of file Acc_trading.php */
/* Location: ./application/controllers/Acc_trading.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-17 08:22:36 */
/* http://harviacode.com */