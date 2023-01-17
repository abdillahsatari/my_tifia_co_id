<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Contact_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'contact?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'contact?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'contact';
            $config['first_url'] = base_url() . 'contact';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Contact_model->total_rows($q);
        $contact = $this->Contact_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'contact_data' => $contact,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Contact';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Contact' => '',
        ];
        $data['code_js'] = 'contact/codejs';
        $data['page'] = 'contact/contact_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Contact_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'first_name' => $row->first_name,
		'last_name' => $row->last_name,
		'address' => $row->address,
		'email' => $row->email,
		'phone' => $row->phone,
		'date_of_birth' => $row->date_of_birth,
	    );
        $data['title'] = 'Contact';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'contact/contact_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contact'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('adminarea/contact/create_action'),
	    'id' => set_value('id'),
	    'first_name' => set_value('first_name'),
	    'last_name' => set_value('last_name'),
	    'address' => set_value('address'),
	    'email' => set_value('email'),
	    'phone' => set_value('phone'),
	    'date_of_birth' => set_value('date_of_birth'),
	);
        $data['title'] = 'Contact';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'contact/contact_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'first_name' => $this->input->post('first_name',TRUE),
		'last_name' => $this->input->post('last_name',TRUE),
		'address' => $this->input->post('address',TRUE),
		'email' => $this->input->post('email',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'date_of_birth' => $this->input->post('date_of_birth',TRUE),
	    );
}
if(! $this->Contact_model->is_exist($this->input->post('id'))){
                $this->Contact_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('adminarea/contact'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id is exist');
            }
    }
    
    public function update($id) 
    {
        $row = $this->Contact_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('adminarea/contact/update_action'),
		'id' => set_value('id', $row->id),
		'first_name' => set_value('first_name', $row->first_name),
		'last_name' => set_value('last_name', $row->last_name),
		'address' => set_value('address', $row->address),
		'email' => set_value('email', $row->email),
		'phone' => set_value('phone', $row->phone),
		'date_of_birth' => set_value('date_of_birth', $row->date_of_birth),
	    );
            $data['title'] = 'Contact';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'contact/contact_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/contact'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'first_name' => $this->input->post('first_name',TRUE),
		'last_name' => $this->input->post('last_name',TRUE),
		'address' => $this->input->post('address',TRUE),
		'email' => $this->input->post('email',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'date_of_birth' => $this->input->post('date_of_birth',TRUE),
	    );

            $this->Contact_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('adminarea/contact'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Contact_model->get_by_id($id);

        if ($row) {
            $this->Contact_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('adminarea/contact'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('adminarea/contact'));
        }
    }

    public function deletebulk(){
        $delete = $this->Contact_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('id', 'id', 'trim|required');
	$this->form_validation->set_rules('first_name', 'first name', 'trim|required');
	$this->form_validation->set_rules('last_name', 'last name', 'trim|required');
	$this->form_validation->set_rules('address', 'address', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('date_of_birth', 'date of birth', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Contact.php */
/* Location: ./application/controllers/Contact.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-06-29 13:41:41 */
/* http://harviacode.com */