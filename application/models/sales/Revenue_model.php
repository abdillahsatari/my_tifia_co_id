<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Revenue_model extends CI_Model
{
    function get_all()
    {
        $this->db->select("marketing_komisi.*, marketing.nama, marketing.kode as kode_sales, nasabah_transaksi_trading.no_akun, nasabah.nasabah_id, nasabah.nama_lengkap AS nama_nasabah, (SELECT role FROM marketing_role WHERE id=marketing.role_id) as jabatan");
        $this->db->where("marketing_komisi.nasabah_transaksi_trading_id=nasabah_transaksi_trading.id");
        $this->db->where("nasabah_transaksi_trading.no_akun=acc_trading.no_akun");
        $this->db->where("acc_trading.nasabah_id=nasabah.nasabah_id");
        $this->db->where("marketing_komisi.marketing_id=marketing.id");
        $this->db->from("marketing_komisi, nasabah_transaksi_trading, acc_trading, nasabah, marketing");
        $this->db->order_by("marketing_komisi.date", "ASC");
        return  $this->db->get()->result();
    }

    // ############################################

    // Komisi
    function make_query_komisi()
    {
        // $marketing_id = sess('mkt');

        $this->db->select("marketing_komisi.*, marketing.nama, marketing.kode as kode_sales, nasabah_transaksi_trading.no_akun, nasabah.nasabah_id, nasabah.nama_lengkap AS nama_nasabah");
        $this->db->where("marketing_komisi.nasabah_transaksi_trading_id=nasabah_transaksi_trading.id");
        $this->db->where("nasabah_transaksi_trading.no_akun=acc_trading.no_akun");
        $this->db->where("acc_trading.nasabah_id=nasabah.nasabah_id");
        $this->db->where("marketing_komisi.marketing_id=marketing.id");
        $this->db->from("marketing_komisi, nasabah_transaksi_trading, acc_trading, nasabah, marketing");

        $column_search = array('marketing.nama', 'marketing.kode', 'nasabah_transaksi_trading.no_akun', 'nasabah.nama_lengkap', 'marketing_komisi.amount_usd', 'marketing_komisi.amount');
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
            $this->db->order_by("marketing_komisi.date", "DESC");
        }
    }
    function make_datatables_komisi()
    {
        $this->make_query_komisi();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_komisi()
    {
        $this->make_query_komisi();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_komisi()
    {
        $this->make_query_komisi();
        return $this->db->count_all_results();
    }
}
