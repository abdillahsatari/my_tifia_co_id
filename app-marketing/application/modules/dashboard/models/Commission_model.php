<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Commission_model extends CI_Model
{

    function apakah_nasabah_saya($nasabah_id, $marketing_id)
    {
        $nasabah = $this->db->query("SELECT parent_id FROM nasabah WHERE nasabah_id='$nasabah_id'")->row_array();

        if ($nasabah['parent_id'] == $marketing_id)
            return TRUE;
        else
            return FALSE;
    }

    // ############################################

    // Komisi Saya
    function make_query_list()
    {
        $marketing_id = sess('mkt');

        $this->db->select("marketing_komisi.*, nasabah_transaksi_trading.no_akun, nasabah.nama_lengkap, nasabah.email, nasabah.nasabah_id");
        $this->db->where("marketing_komisi.marketing_id", $marketing_id);
        $this->db->where("marketing_komisi.nasabah_transaksi_trading_id=nasabah_transaksi_trading.id");
        $this->db->where("nasabah_transaksi_trading.no_akun=acc_trading.no_akun");
        $this->db->where("acc_trading.nasabah_id=nasabah.nasabah_id");
        $this->db->from("marketing_komisi, nasabah_transaksi_trading, acc_trading, nasabah");

        $column_search = array('nasabah.nama_lengkap', 'nasabah_transaksi_trading.no_akun', 'email', 'no_hp');
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
            $order_column = array(null, null, null, 'amount', 'amount_usd', 'date');
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("marketing_komisi.date", "DESC");
        }
    }
    function make_datatables_list()
    {
        $this->make_query_list();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_list()
    {
        $this->make_query_list();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_list()
    {
        $this->make_query_list();
        return $this->db->count_all_results();
    }

    // Komisi Team
    function make_query_teamCommission()
    {
        $marketing_id = sess('mkt');

        // get id team saya
        $direct_child_id = $this->tree->get_all_child_id($marketing_id);
        $last = count($direct_child_id) - 1;
        $where = '(';
        foreach ($direct_child_id as $index => $value) {
            if ($index == $last) { // this is last array
                $where .= 'marketing_komisi.marketing_id="' . $value . '"';
            } else { // this is not last array
                $where .= 'marketing_komisi.marketing_id="' . $value . '" OR ';
            }
        }
        $where .= ')';


        $this->db->select("marketing_komisi.*, marketing.nama AS nama_sales, marketing.kode AS kode_sales, nasabah_transaksi_trading.no_akun, nasabah.nama_lengkap, nasabah.email, nasabah.nasabah_id");
        $this->db->where($where);
        $this->db->where("marketing_komisi.nasabah_transaksi_trading_id=nasabah_transaksi_trading.id");
        $this->db->where("marketing_komisi.marketing_id=marketing.id");
        $this->db->where("nasabah_transaksi_trading.no_akun=acc_trading.no_akun");
        $this->db->where("acc_trading.nasabah_id=nasabah.nasabah_id");
        $this->db->from("marketing_komisi, nasabah_transaksi_trading, acc_trading, nasabah, marketing");


        $column_search = array('nasabah.nama_lengkap', 'nasabah_transaksi_trading.no_akun', 'email', 'no_hp');
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
            $order_column = array(null, null, 'amount', 'amount_usd', 'date');
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("marketing_komisi.date", "DESC");
        }
    }
    function make_datatables_teamCommission()
    {
        $this->make_query_teamCommission();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_teamCommission()
    {
        $this->make_query_teamCommission();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_teamCommission()
    {
        $this->make_query_teamCommission();
        return $this->db->count_all_results();
    }
}
