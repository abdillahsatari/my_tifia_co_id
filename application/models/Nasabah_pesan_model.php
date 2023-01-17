<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nasabah_pesan_model extends CI_Model
{

    public $table = 'nasabah_pesan';
    public $id = 'nasabah_pesan_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // $this->datatables->select('*');
        $this->datatables->select('nasabah_pesan_id, nama_lengkap, tujuan, subject, isi, status, create_date');
        $this->datatables->from('nasabah_pesan');
        $this->datatables->join('nasabah', 'nasabah_pesan.nasabah_id = nasabah.nasabah_id');
        //add this line for join
        //$this->datatables->join('table2', 'nasabah_pesan.field = table2.field');
        // $this->datatables->add_column('action', anchor(site_url('adminarea/nasabah_pesan/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/nasabah_pesan/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')."  ".anchor(site_url('adminarea/nasabah_pesan/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'adminarea/nasabah_pesan/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'nasabah_pesan_id');
        $this->datatables->add_column('action', anchor(site_url('adminarea/nasabah_pesan/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/nasabah_pesan/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'), 'nasabah_pesan_id');
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
        $this->db->join('nasabah', 'nasabah.nasabah_id='.$this->table.'.nasabah_id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_one_by_id_join($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('nasabah', 'nasabah.nasabah_id='.$this->table.'.nasabah_id');
        $this->db->where($this->id, $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get()->row();
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
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('nasabah_pesan_id', $q);
	$this->db->or_like('nasabah_id', $q);
	$this->db->or_like('tujuan', $q);
	$this->db->or_like('subject', $q);
	$this->db->or_like('isi', $q);
	$this->db->or_like('gambar', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('create_date', $q);
	$this->db->or_like('update_date', $q);
	$this->db->or_like('user_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('nasabah_pesan_id', $q);
	$this->db->or_like('nasabah_id', $q);
	$this->db->or_like('tujuan', $q);
	$this->db->or_like('subject', $q);
	$this->db->or_like('isi', $q);
	$this->db->or_like('gambar', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('create_date', $q);
	$this->db->or_like('update_date', $q);
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

    function get_count()
    {
        $query = $this->db->get($this->table);
        if($query->num_rows()>0) {
          return $query->num_rows();
        }
        else
        {
          return 0;
        }
    }
}

/* End of file Nasabah_pesan_model.php */
/* Location: ./application/models/Nasabah_pesan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-14 13:33:39 */
/* http://harviacode.com */