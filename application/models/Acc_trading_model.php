<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acc_trading_model extends CI_Model
{

    public $table = 'acc_trading';
    public $id = 'no_akun';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('no_akun, nama_lengkap, email, type, nama_currency, nama_leverage, tanggal_buat_akun, status_aktif');
        $this->datatables->from('acc_trading');
        $this->datatables->join('nasabah', 'acc_trading.nasabah_id = nasabah.nasabah_id');
        $this->datatables->join('acc_type', 'acc_trading.acc_type_id = acc_type.acc_type_id');
        $this->datatables->join('acc_currency', 'acc_trading.acc_currency_id = acc_currency.acc_currency_id');
        $this->datatables->join('acc_leverage', 'acc_trading.acc_leverage_id = acc_leverage.acc_leverage_id');
        $this->datatables->where('jenis', 'Real');
        //add this line for join
        //$this->datatables->join('table2', 'acc_trading.field = table2.field');
        //$this->datatables->add_column('action', anchor(site_url('adminarea/acc_trading/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/acc_trading/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')."  ".anchor(site_url('adminarea/acc_trading/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'adminarea/acc_trading/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'no_akun');
        $this->datatables->add_column('action', anchor(site_url('adminarea/acc_trading/read/$1'), '<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"'), 'no_akun');
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

    function get_all_join()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('acc_currency', $this->table . '.acc_currency_id=acc_currency.acc_currency_id');
        $this->db->join('acc_leverage', $this->table . '.acc_leverage_id=acc_leverage.acc_leverage_id');
        $this->db->join('acc_type', $this->table . '.acc_type_id=acc_type.acc_type_id');
        $this->db->join('nasabah', $this->table . '.nasabah_id=nasabah.nasabah_id');
        return $this->db->get()->result();
    }

    function get_by_id_nasabah($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('acc_currency', $this->table . '.acc_currency_id=acc_currency.acc_currency_id');
        $this->db->join('acc_leverage', $this->table . '.acc_leverage_id=acc_leverage.acc_leverage_id');
        $this->db->join('acc_type', $this->table . '.acc_type_id=acc_type.acc_type_id');
        $this->db->join('nasabah', $this->table . '.nasabah_id=nasabah.nasabah_id');
        $this->db->where($this->table . '.nasabah_id', $id);
        return $this->db->get()->result();
    }

    function get_by_id_noakun_join($noakun)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('acc_currency', $this->table . '.acc_currency_id=acc_currency.acc_currency_id');
        $this->db->join('acc_leverage', $this->table . '.acc_leverage_id=acc_leverage.acc_leverage_id');
        $this->db->join('acc_type', $this->table . '.acc_type_id=acc_type.acc_type_id');
        $this->db->join('nasabah', $this->table . '.nasabah_id=nasabah.nasabah_id');
        $this->db->where('no_akun', $noakun);
        return $this->db->get()->row();
    }

    function get_acc_currency()
    {
        $this->db->select('*');
        $this->db->from('acc_currency');
        $this->db->where('status_currency', 'Aktif');
        return $this->db->get()->result();
    }

    function get_acc_leverage()
    {
        $this->db->select('*');
        $this->db->from('acc_leverage');
        $this->db->where('status_leverage', 'Aktif');
        return $this->db->get()->result();
    }

    function get_acc_type($jenis = 'Real')
    {
        $this->db->select('*');
        $this->db->from('acc_type');
        $this->db->where('jenis', $jenis);
        $this->db->where('status_type', 'Aktif');
        return $this->db->get()->result();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('no_akun', $q);
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

    function get_count($id)
    {
        $this->db->select('Count(no_akun) as jml');
        $this->db->from($this->table);
        $this->db->where('nasabah_id', $id);
        return $this->db->get()->row();
    }
}

/* End of file Acc_trading_model.php */
/* Location: ./application/models/Acc_trading_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-17 08:22:36 */
/* http://harviacode.com */