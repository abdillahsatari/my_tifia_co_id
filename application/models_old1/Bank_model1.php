<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bank_model extends CI_Model
{

    public $table = 'bank';
    public $id = 'bank_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('bank_id,nasabah_id,nama_bank,no_rekening,cabang,jenis_rekening,telepon_bank,kode_bank,atas_nama,currency,created_date,update_date,status');
        $this->datatables->from('bank');
        //add this line for join
        //$this->datatables->join('table2', 'bank.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('adminarea/bank/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/bank/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')."  ".anchor(site_url('adminarea/bank/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'adminarea/bank/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'bank_id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_by_id_join($value)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('nasabah', 'nasabah.nasabah_id='.$this->table.'.nasabah_id');
        $this->db->where($this->table.'.nasabah_id', $value);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get()->result();
    }

    function get_all_where($key, $value) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array($key => $value));
        $this->db->order_by($this->id, $this->order);
        return $this->db->get()->result();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('bank_id', $q);
	$this->db->or_like('nasabah_id', $q);
	$this->db->or_like('nama_bank', $q);
	$this->db->or_like('no_rekening', $q);
	$this->db->or_like('cabang', $q);
	$this->db->or_like('jenis_rekening', $q);
	$this->db->or_like('telepon_bank', $q);
	$this->db->or_like('kode_bank', $q);
	$this->db->or_like('atas_nama', $q);
	$this->db->or_like('currency', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('update_date', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('bank_id', $q);
	$this->db->or_like('nasabah_id', $q);
	$this->db->or_like('nama_bank', $q);
	$this->db->or_like('no_rekening', $q);
	$this->db->or_like('cabang', $q);
	$this->db->or_like('jenis_rekening', $q);
	$this->db->or_like('telepon_bank', $q);
	$this->db->or_like('kode_bank', $q);
	$this->db->or_like('atas_nama', $q);
	$this->db->or_like('currency', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('update_date', $q);
	$this->db->or_like('status', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete bulkdata
    function deletebulk(){
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data); 
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }


}

/* End of file Bank_model.php */
/* Location: ./application/models/Bank_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-10 10:45:45 */
/* http://harviacode.com */