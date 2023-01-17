<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transactions_model extends CI_Model
{
    function get_all()
    {
        $this->db->select("nasabah_transaksi_trading.*, nasabah.nama_lengkap");
        $this->db->where("nasabah_transaksi_trading.no_akun=acc_trading.no_akun");
        $this->db->where("acc_trading.nasabah_id=nasabah.nasabah_id");
        $this->db->from("nasabah_transaksi_trading, acc_trading, nasabah");
        $this->db->order_by("id", "DESC");
        $this->db->order_by("date", "DESC");
        return  $this->db->get()->result();
    }

    // ############################################

    // transaksi_trading
    function make_query_transaksi_trading()
    {
        $this->db->select("nasabah_transaksi_trading.*, nasabah.nama_lengkap");
        $this->db->where("nasabah_transaksi_trading.no_akun=acc_trading.no_akun");
        $this->db->where("acc_trading.nasabah_id=nasabah.nasabah_id");
        $this->db->from("nasabah_transaksi_trading, acc_trading, nasabah");

        $column_search = array('nasabah.nama_lengkap', 'no_akun', 'tipe', 'lot');
        $i = 0;
        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST["order"])) {
            $order_column = array(null, null, null, null, null);
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("id", "DESC");
            $this->db->order_by("date", "DESC");
        }
    }
    function make_datatables_transaksi_trading()
    {
        $this->make_query_transaksi_trading();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_transaksi_trading()
    {
        $this->make_query_transaksi_trading();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_transaksi_trading()
    {
        $this->make_query_transaksi_trading();
        return $this->db->count_all_results();
    }
}
