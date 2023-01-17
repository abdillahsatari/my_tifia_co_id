<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Withdraw_model extends CI_Model
{

    public $table = 'withdraw';
    public $id = 'withdraw_id';
    public $status = 'status_withdraw';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('withdraw_id, nama_lengkap, no_akun, total, status_withdraw, tanggal_withdraw');
        $this->datatables->from('withdraw');
        $this->datatables->join('nasabah', 'withdraw.nasabah_id = nasabah.nasabah_id');
        $this->datatables->where('status_withdraw !=', 'Done')->where('status_withdraw !=', 'Approve');
        //add this line for join

        $this->datatables->add_column(
            'action',
            // anchor(site_url('adminarea/withdraw/read/$1'), '<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"') . "  " . 
            anchor(site_url('adminarea/withdraw/update/$1'), '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'),
            'withdraw_id'
        );
        return $this->datatables->generate();
    }

    function jsonaccWd()
    {
        /**
         *
         *  [Deprecated]
         *
         **/

        $this->datatables->select('withdraw_id, nama_lengkap, no_akun, total, status_withdraw, tanggal_withdraw');
        $this->datatables->from('withdraw');
        $this->datatables->join('nasabah', 'withdraw.nasabah_id = nasabah.nasabah_id');
        $this->datatables->where('status_withdraw', 'Approve');
        //add this line for join

        $this->datatables->add_column(
            'action',
            anchor(site_url('adminarea/withdraw_acc/update/$1'), '<i class="fa fa-thumbs-up"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Transfer set Done"'),
            'withdraw_id'
        );
        return $this->datatables->generate();
    }
    function jswithdrawreport()
    {
        $this->datatables->select('withdraw_id, nama_lengkap, no_akun, total, status_withdraw, tanggal_withdraw');
        $this->datatables->from('withdraw');
        $this->datatables->join('nasabah', 'withdraw.nasabah_id = nasabah.nasabah_id');
        $this->datatables->where('status_withdraw', 'Done');
        //add this line for join

        $this->datatables->add_column('', '');
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
        $this->db->join('nasabah', $this->table . '.nasabah_id=nasabah.nasabah_id');
        $this->db->join('bank', $this->table . '.bank_id=bank.bank_id');
        $this->db->join('acc_trading', $this->table . '.no_akun=acc_trading.no_akun');
        $this->db->join('acc_type', 'acc_trading.acc_type_id=acc_type.acc_type_id');
        $this->db->join('acc_currency', 'acc_trading.acc_currency_id=acc_currency.acc_currency_id');
        $this->db->join('acc_leverage', 'acc_trading.acc_leverage_id=acc_leverage.acc_leverage_id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_join_bystatus($status)
    {

        $this->db->where($this->status, $status);
        $this->db->join('nasabah', $this->table . '.nasabah_id=nasabah.nasabah_id');
        $this->db->join('bank', $this->table . '.bank_id=bank.bank_id');
        $this->db->join('acc_trading', $this->table . '.no_akun=acc_trading.no_akun');
        $this->db->join('acc_type', 'acc_trading.acc_type_id=acc_type.acc_type_id');
        $this->db->join('acc_currency', 'acc_trading.acc_currency_id=acc_currency.acc_currency_id');
        $this->db->join('acc_leverage', 'acc_trading.acc_leverage_id=acc_leverage.acc_leverage_id');
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
        $this->db->join('nasabah', $this->table . '.nasabah_id=nasabah.nasabah_id');
        $this->db->join('bank', $this->table . '.bank_id=bank.bank_id');
        $this->db->join('acc_trading', $this->table . '.no_akun=acc_trading.no_akun');
        $this->db->join('acc_type', 'acc_trading.acc_type_id=acc_type.acc_type_id');
        $this->db->join('acc_currency', 'acc_trading.acc_currency_id=acc_currency.acc_currency_id');
        $this->db->join('acc_leverage', 'acc_trading.acc_leverage_id=acc_leverage.acc_leverage_id');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_by_id_nasabah($id)
    {
        $this->db->where('nasabah_id', $id);
        return $this->db->get($this->table)->result();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('withdraw_id', $q);
        $this->db->or_like('nasabah_id', $q);
        $this->db->or_like('no_akun', $q);
        $this->db->or_like('wallet_id', $q);
        $this->db->or_like('bank_id', $q);
        $this->db->or_like('total', $q);
        $this->db->or_like('status_withdraw', $q);
        $this->db->or_like('sumber_withdraw', $q);
        $this->db->or_like('tanggal_withdraw', $q);
        $this->db->or_like('kode_withdraw', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('withdraw_id', $q);
        $this->db->or_like('nasabah_id', $q);
        $this->db->or_like('no_akun', $q);
        $this->db->or_like('wallet_id', $q);
        $this->db->or_like('bank_id', $q);
        $this->db->or_like('total', $q);
        $this->db->or_like('status_withdraw', $q);
        $this->db->or_like('sumber_withdraw', $q);
        $this->db->or_like('tanggal_withdraw', $q);
        $this->db->or_like('kode_withdraw', $q);
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

    function get_count()
    {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    function get_sum($id)
    {
        $this->db->select('SUM(total) as jml');
        $this->db->from($this->table);
        $this->db->where('nasabah_id', $id);
        $this->db->where('status_withdraw', 'Approve');
        return $this->db->get()->row();
    }

    function get_sum_all()
    {
        $this->db->select('SUM(total) as jml');
        $this->db->from($this->table);
        $this->db->where('status_withdraw', 'Done');
        return $this->db->get()->row();
    }

    // custom
    public function get_currency_aktif()
    {
        $query = $this->db->query('SELECT withdraw_rate FROM acc_currency WHERE status_currency="Aktif"');

        if ($query->num_rows() == 1) {
            $row = $query->row_array();
            return floatval($row['withdraw_rate']);
        } else {
            return 10000;
        }
    }
}

/* End of file Withdraw_model.php */
/* Location: ./application/models/Withdraw_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-14 22:17:37 */
/* http://harviacode.com */