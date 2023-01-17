<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acc_demo_model extends CI_Model
{

    public $table = 'acc_demo';
    public $id = 'no_akun';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('no_akun, nama_lengkap, email, type, tanggal_buat_akun, status_aktif');
        // $this->datatables->select('no_akun');
        $this->datatables->from('acc_demo');
        $this->datatables->join('acc_type', 'acc_demo.acc_type_id = acc_type.acc_type_id');
        $this->datatables->join('nasabah', 'acc_demo.nasabah_id = nasabah.nasabah_id');
        $this->datatables->where('jenis', 'Demo');
        //add this line for join
        //$this->datatables->join('table2', 'acc_demo.field = table2.field');
        // $this->datatables->add_column('action', anchor(site_url('adminarea/acc_demo/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/acc_demo/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')."  ".anchor(site_url('adminarea/acc_demo/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'adminarea/acc_demo/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'no_akun');
        $this->datatables->add_column('action', anchor(site_url('adminarea/acc_demo/read/$1'), '<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"'), 'no_akun');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->join('acc_type', 'acc_demo.acc_type_id = acc_type.acc_type_id');
        $this->db->join('nasabah', 'acc_demo.nasabah_id = nasabah.nasabah_id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->join('acc_type', 'acc_demo.acc_type_id = acc_type.acc_type_id');
        $this->db->join('nasabah', 'acc_demo.nasabah_id = nasabah.nasabah_id');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_by_id_nasabah($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('acc_type', $this->table . '.acc_type_id=acc_type.acc_type_id');
        $this->db->join('nasabah', $this->table . '.nasabah_id=nasabah.nasabah_id');
        $this->db->where($this->table . '.nasabah_id', $id);
        return $this->db->get()->result();
    }
  
  
  	function get_by_id_noakun($noakun)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('nasabah', $this->table . '.nasabah_id=nasabah.nasabah_id');
        $this->db->where('no_akun', $noakun);
        return $this->db->get()->row();
    }

    function get_by_id_nasabah_last($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('nasabah_id', $id);
        $this->db->where('status_aktif', 'Aktif');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get()->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('no_akun', $q);
        $this->db->or_like('no_akun', $q);
        $this->db->or_like('acc_currency_id', $q);
        $this->db->or_like('acc_leverage_id', $q);
        $this->db->or_like('nasabah_id', $q);
        $this->db->or_like('acc_type_id', $q);
        $this->db->or_like('komisi', $q);
        $this->db->or_like('percent_req', $q);
        $this->db->or_like('password_trade', $q);
        $this->db->or_like('password_investor', $q);
        $this->db->or_like('ip', $q);
        $this->db->or_like('port', $q);
        $this->db->or_like('tanggal_buat_akun', $q);
        $this->db->or_like('tanggal_terakhir_login', $q);
        $this->db->or_like('status_aktif', $q);
        $this->db->or_like('user_id', $q);
        $this->db->or_like('balance', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('no_akun', $q);
        $this->db->or_like('no_akun', $q);
        $this->db->or_like('acc_currency_id', $q);
        $this->db->or_like('acc_leverage_id', $q);
        $this->db->or_like('nasabah_id', $q);
        $this->db->or_like('acc_type_id', $q);
        $this->db->or_like('komisi', $q);
        $this->db->or_like('percent_req', $q);
        $this->db->or_like('password_trade', $q);
        $this->db->or_like('password_investor', $q);
        $this->db->or_like('ip', $q);
        $this->db->or_like('port', $q);
        $this->db->or_like('tanggal_buat_akun', $q);
        $this->db->or_like('tanggal_terakhir_login', $q);
        $this->db->or_like('status_aktif', $q);
        $this->db->or_like('user_id', $q);
        $this->db->or_like('balance', $q);
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
    function deletebulk()
    {
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data);
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }
    //check pk data is exists 

    function is_exist($id)
    {
        $query = $this->db->get_where($this->table, array($this->id => $id));
        $count = $query->num_rows();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_count()
    {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    function getData($nasabah_id)
    {
        return $this->db->select("*")->from($this->table)->where("nasabah_id", $nasabah_id)->get()->result();
    }
}

/* End of file Acc_demo_model.php */
/* Location: ./application/models/Acc_demo_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-17 08:25:39 */
/* http://harviacode.com */