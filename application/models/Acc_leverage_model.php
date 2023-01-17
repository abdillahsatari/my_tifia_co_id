<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acc_leverage_model extends CI_Model
{

    public $table = 'acc_leverage';
    public $id = 'acc_leverage_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('acc_leverage_id,leverage,nama_leverage,status_leverage,date');
        $this->datatables->from('acc_leverage');
        //add this line for join
        //$this->datatables->join('table2', 'acc_leverage.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('adminarea/acc_leverage/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/acc_leverage/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')."  ".anchor(site_url('adminarea/acc_leverage/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'acc_leverage/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'acc_leverage_id');
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
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('acc_leverage_id', $q);
	$this->db->or_like('leverage', $q);
	$this->db->or_like('nama_leverage', $q);
	$this->db->or_like('status_leverage', $q);
	$this->db->or_like('date', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('acc_leverage_id', $q);
	$this->db->or_like('leverage', $q);
	$this->db->or_like('nama_leverage', $q);
	$this->db->or_like('status_leverage', $q);
	$this->db->or_like('date', $q);
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

/* End of file Acc_leverage_model.php */
/* Location: ./application/models/Acc_leverage_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-18 18:26:43 */
/* http://harviacode.com */