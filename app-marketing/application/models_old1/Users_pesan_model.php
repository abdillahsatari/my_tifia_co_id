<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_pesan_model extends CI_Model
{

    public $table = 'users_pesan';
    public $id = 'users_pesan_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    // datatables
    function json() {
        $this->datatables->select('users_pesan_id, nasabah.email as emailnasabah, nama_lengkap, subject, date, username');
        $this->datatables->from('users_pesan');
        $this->datatables->join('nasabah', 'users_pesan.nasabah_id = nasabah.nasabah_id');
        $this->datatables->join('users', 'users_pesan.user_id = users.id');
        //add this line for join
        //$this->datatables->join('table2', 'users_pesan.field = table2.field');
        // $this->datatables->add_column('action', anchor(site_url('adminarea/users_pesan/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/users_pesan/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')."  ".anchor(site_url('adminarea/users_pesan/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'adminarea/users_pesan/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'users_pesan_id');

        $this->datatables->add_column('action', anchor(site_url('adminarea/users_pesan/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"'), 'users_pesan_id');
        return $this->datatables->generate();
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_join()
    {
        $this->db->select('*');
        $this->db->select('users_pesan_id, users_pesan.user_id as user, nasabah.email as emailnasabah');
        $this->db->join('nasabah', 'users_pesan.nasabah_id = nasabah.nasabah_id');
        $this->db->join('users', 'users_pesan.user_id = users.id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_by_nasabah($id)
    {
        $this->db->where('nasabah_id', $id);
        $this->db->limit('10');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_by_nasabah_nolimit($id)
    {
        $this->db->where('nasabah_id', $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_by_id_join($id)
    {
        $this->db->select('*');
        $this->db->select('users_pesan_id, users_pesan.user_id as user, nasabah.email as emailnasabah');
        $this->db->join('nasabah', 'users_pesan.nasabah_id = nasabah.nasabah_id');
        $this->db->join('users', 'users_pesan.user_id = users.id');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('users_pesan_id', $q);
	$this->db->or_like('nasabah_id', $q);
	$this->db->or_like('subject', $q);
	$this->db->or_like('isi', $q);
	$this->db->or_like('lampiran', $q);
	$this->db->or_like('date', $q);
	$this->db->or_like('user_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('users_pesan_id', $q);
	$this->db->or_like('nasabah_id', $q);
	$this->db->or_like('subject', $q);
	$this->db->or_like('isi', $q);
	$this->db->or_like('lampiran', $q);
	$this->db->or_like('date', $q);
	$this->db->or_like('user_id', $q);
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

/* End of file Users_pesan_model.php */
/* Location: ./application/models/Users_pesan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-18 18:06:13 */
/* http://harviacode.com */