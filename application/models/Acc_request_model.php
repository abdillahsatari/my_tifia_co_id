<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acc_request_model extends CI_Model
{

    public $table = 'acc_request';
    public $id = 'acc_request_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('acc_request_id, nama_lengkap, email, type, acc_request.date as tanggal_request, status_request');
        // $this->datatables->select('acc_request_id, acc_request.date as tanggal_request');
        $this->datatables->from('acc_request');
        $this->datatables->join('acc_type', 'acc_request.acc_type_id = acc_type.acc_type_id');
        $this->datatables->join('nasabah', 'acc_request.nasabah_id = nasabah.nasabah_id');
        $this->datatables->where("jenis !=", "Demo")->where("status_request", "Dikonfirmasi");
        //add this line for join
        //$this->datatables->join('table2', 'acc_request.field = table2.field');
        // $this->datatables->add_column('action', anchor(site_url('adminarea/acc_request/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/acc_request/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')."  ".anchor(site_url('adminarea/acc_request/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'adminarea/acc_request/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'acc_request_id');
        $this->datatables->add_column('action', anchor(site_url('adminarea/acc_request/read/$1'), '<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"') . "  " . anchor(site_url('adminarea/acc_request/update/$1'), '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'), 'acc_request_id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        // $this->db->order_by($this->id, $this->order);
        // return $this->db->get($this->table)->result();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('nasabah', 'acc_request.nasabah_id = nasabah.nasabah_id');
        $this->db->join('acc_type', 'acc_request.acc_type_id = acc_type.acc_type_id');
        $this->db->join('acc_currency', 'acc_request.acc_currency_id = acc_currency.acc_currency_id', 'left');
        $this->db->join('acc_leverage', 'acc_request.acc_leverage_id = acc_leverage.acc_leverage_id', 'left');
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_last_by_id_nasabah($id)
    {
        $this->db->where('nasabah_id', $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->row();
    }

    function get_by_id_join($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('nasabah', 'acc_request.nasabah_id = nasabah.nasabah_id');
        $this->db->join('acc_type', 'acc_request.acc_type_id = acc_type.acc_type_id');
        $this->db->join('acc_currency', 'acc_request.acc_currency_id = acc_currency.acc_currency_id', 'left');
        $this->db->join('acc_leverage', 'acc_request.acc_leverage_id = acc_leverage.acc_leverage_id', 'left');
        $this->db->where($this->id, $id);
        return $this->db->get()->row();
    }

    function get_by_id_nasabah_join_demo($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('nasabah', 'acc_request.nasabah_id = nasabah.nasabah_id');
        $this->db->join('acc_type', 'acc_request.acc_type_id = acc_type.acc_type_id');
        // $this->db->join('acc_currency', 'acc_request.acc_currency_id = acc_currency.acc_currency_id', 'left');
        // $this->db->join('acc_leverage', 'acc_request.acc_leverage_id = acc_leverage.acc_leverage_id', 'left');
        $this->db->join('acc_demo', 'acc_request.acc_request_id = acc_demo.acc_request_id', 'left');
        $this->db->where('jenis', 'Demo');
        $this->db->where('nasabah.nasabah_id', $id);
        return $this->db->get()->result();
    }

    function get_by_id_nasabah_join_real($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('nasabah', 'acc_request.nasabah_id = nasabah.nasabah_id');
        $this->db->join('acc_type', 'acc_request.acc_type_id = acc_type.acc_type_id');
        $this->db->join('acc_currency', 'acc_request.acc_currency_id = acc_currency.acc_currency_id', 'left');
        $this->db->join('acc_leverage', 'acc_request.acc_leverage_id = acc_leverage.acc_leverage_id', 'left');
        $this->db->join('acc_trading', 'acc_request.acc_request_id = acc_trading.acc_request_id', 'left');
        $this->db->where('jenis', 'Real');
        $this->db->where('nasabah.nasabah_id', $id);
        return $this->db->get()->result();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('acc_request_id', $q);
        $this->db->or_like('nasabah_id', $q);
        $this->db->or_like('acc_currency_id', $q);
        $this->db->or_like('acc_type_id', $q);
        $this->db->or_like('acc_leverage_id', $q);
        $this->db->or_like('date', $q);
        $this->db->or_like('status_request', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('acc_request_id', $q);
        $this->db->or_like('nasabah_id', $q);
        $this->db->or_like('acc_currency_id', $q);
        $this->db->or_like('acc_type_id', $q);
        $this->db->or_like('acc_leverage_id', $q);
        $this->db->or_like('date', $q);
        $this->db->or_like('status_request', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
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
    function deletebulk()
    {
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data);
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }

    public function get_last_request($value)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('nasabah_id', $value);
        $this->db->where('status_request', 'Dikonfirmasi');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get()->row();
    }

    public function get_last_request_demo($value)
    {
        /**
         *
         *  [Deprecated]
         *
        **/

        $this->db->select($this->table . '.*');
        $this->db->from($this->table . ',acc_type');
        $this->db->where($this->table . '.acc_type_id = acc_type.acc_type_id');
        $this->db->where('nasabah_id', $value);
        $this->db->where('jenis', 'Demo');
        $this->db->where('status_request !=', 'Aktif');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get()->row();
    }

    public function get_last_request_real($value)
    {
        $this->db->select($this->table . '.*');
        $this->db->from($this->table . ',acc_type');
        $this->db->where($this->table . '.acc_type_id = acc_type.acc_type_id');
        $this->db->where('nasabah_id', $value);
        $this->db->where('jenis', 'Real');
        $this->db->where('status_request !=', 'Aktif');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get()->row();
    }
}

/* End of file Acc_request_model.php */
/* Location: ./application/models/Acc_request_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-17 07:29:59 */
/* http://harviacode.com */