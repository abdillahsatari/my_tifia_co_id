<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Deposit_model extends CI_Model
{

    public $table = 'deposit';
    public $id = 'deposit_id';
    public $status = 'status_deposit';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('deposit_id,no_akun,nama_lengkap,email,format(total, 0) as total,type_deposit,status_deposit,tanggal_deposit');
        $this->datatables->from('deposit');
        $this->datatables->join('nasabah', 'nasabah.nasabah_id=deposit.nasabah_id');
        $this->datatables->where("status_deposit !=", 'Sukses')->where("status_deposit !=", 'Approve');
        //add this line for join
        //$this->datatables->join('table2', 'deposit.field = table2.field');
        // $this->datatables->add_column('action', anchor(site_url('adminarea/deposit/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/deposit/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')."  ".anchor(site_url('adminarea/deposit/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'adminarea/deposit/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'deposit_id');
        $this->datatables->add_column('action', anchor(site_url('adminarea/deposit/read/$1'), '<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"') . "  " . anchor(site_url('adminarea/deposit/update/$1'), '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'), 'deposit_id');
        return $this->datatables->generate();
    }

    function jsonList()
    {
        $this->datatables->select('deposit_id,no_akun,nama_lengkap,email,format(total, 0) as total,type_deposit,status_deposit,tanggal_deposit');
        $this->datatables->from('deposit');
        $this->datatables->join('nasabah', 'nasabah.nasabah_id=deposit.nasabah_id');
        $this->datatables->where("status_deposit", 'Sukses');
        //add this line for join
        //$this->datatables->join('table2', 'deposit.field = table2.field');
        // $this->datatables->add_column('action', anchor(site_url('adminarea/deposit/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/deposit/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')."  ".anchor(site_url('adminarea/deposit/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'adminarea/deposit/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'deposit_id');
        $this->datatables->add_column(
            'action',
            anchor(site_url('adminarea/deposit/read/$1'), '<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"'),
            'deposit_id'
        );
        return $this->datatables->generate();
    }

    function jsonTrasferBalance()
    {
        $this->datatables->select('deposit_id,no_akun,nama_lengkap,email,format(total, 0) as total,type_deposit,status_deposit,tanggal_deposit');
        $this->datatables->from('deposit');
        $this->datatables->where("status_deposit !=", 'Sukses');
        $this->datatables->join('nasabah', 'nasabah.nasabah_id=deposit.nasabah_id')->where("status_deposit !=", "Reject");
        //add this line for join
        //$this->datatables->join('table2', 'deposit.field = table2.field');
        // $this->datatables->add_column('action', anchor(site_url('adminarea/deposit/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/deposit/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')."  ".anchor(site_url('adminarea/deposit/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'adminarea/deposit/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'deposit_id');
        $this->datatables->add_column(
            'action',
            anchor(site_url('adminarea/transferbalance/update/$1'), '<i class="fas fa-arrow-right"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"'),
            'deposit_id'
        );
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

    function get_by_join($id)
    {
        $this->db->where($this->id, $id);
        $this->db->from($this->table);
        $this->db->join('nasabah', 'nasabah.nasabah_id=deposit.nasabah_id');
        $this->db->join('bank', 'bank.bank_id=deposit.bank_id');
        return $this->db->get()->row();
    }

    function get_by_id_join($id)
    {

        $this->db->join('nasabah', 'nasabah.nasabah_id=deposit.nasabah_id');
        $this->db->join('bank', 'bank.bank_id=deposit.bank_id');
        $this->db->join('acc_trading', 'acc_trading.no_akun=deposit.no_akun');
        $this->db->join('acc_currency', 'acc_currency.acc_currency_id=acc_trading.acc_currency_id');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_by_all_join()
    {
        $this->db->join('nasabah', 'nasabah.nasabah_id=deposit.nasabah_id');
        $this->db->join('bank', 'bank.bank_id=deposit.bank_id');
        $this->db->join('acc_trading', 'acc_trading.no_akun=deposit.no_akun');
        $this->db->join('acc_currency', 'acc_currency.acc_currency_id=acc_trading.acc_currency_id');
        return $this->db->get($this->table)->result();
    }

    function get_by_all_join_bystatus($status)
    {
        $this->db->where($this->status, $status);
        $this->db->join('nasabah', 'nasabah.nasabah_id=deposit.nasabah_id');
        $this->db->join('bank', 'bank.bank_id=deposit.bank_id');
        $this->db->join('acc_trading', 'acc_trading.no_akun=deposit.no_akun');
        $this->db->join('acc_currency', 'acc_currency.acc_currency_id=acc_trading.acc_currency_id');

        return $this->db->get($this->table)->result();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('deposit_id', $q);
        $this->db->or_like('no_akun', $q);
        $this->db->or_like('nasabah_id', $q);
        $this->db->or_like('bank_id', $q);
        $this->db->or_like('total', $q);
        $this->db->or_like('acc_currency_id', $q);
        $this->db->or_like('bukti_transfer', $q);
        $this->db->or_like('type_deposit', $q);
        $this->db->or_like('status_deposit', $q);
        $this->db->or_like('tanggal_deposit', $q);
        $this->db->or_like('id_operator', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('deposit_id', $q);
        $this->db->or_like('no_akun', $q);
        $this->db->or_like('nasabah_id', $q);
        $this->db->or_like('bank_id', $q);
        $this->db->or_like('total', $q);
        $this->db->or_like('acc_currency_id', $q);
        $this->db->or_like('bukti_transfer', $q);
        $this->db->or_like('type_deposit', $q);
        $this->db->or_like('status_deposit', $q);
        $this->db->or_like('tanggal_deposit', $q);
        $this->db->or_like('id_operator', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        // return $this->db->insert_id();
    }

    // insert data
    function insert_id($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // update data
    function update($id, $data)
    {
        // $this->db->insert($this->table, $data);
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // update data
    function updateStatus($id, $data)
    {
        // $this->db->insert($this->table, $data);
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

    function get_count()
    {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    function get_by_id_nasabah($id)
    {
        $this->db->where('nasabah_id', $id);
        return $this->db->get($this->table)->result();
    }

    function get_sum($id)
    {
        $this->db->select('SUM(total) as jml');
        $this->db->from($this->table);
        $this->db->where('nasabah_id', $id);
        $this->db->where('status_deposit', 'Approve');
        return $this->db->get()->row();
    }

    function get_sum_all()
    {
        $this->db->select('SUM(total) as jml');
        $this->db->from($this->table);
        $this->db->where('status_deposit', 'Sukses');
        return $this->db->get()->row();
    }
}

/* End of file Deposit_model.php */
/* Location: ./application/models/Deposit_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-11 01:10:23 */
/* http://harviacode.com */