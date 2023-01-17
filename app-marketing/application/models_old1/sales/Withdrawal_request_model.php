<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Withdrawal_request_model extends CI_Model
{
    function get_all()
    {
        $this->db->select("marketing_withdrawal.*, marketing.nama, marketing.kode as kode_sales");
        // $this->db->where("marketing_withdrawal.marketing_id", $marketing_id);
        $this->db->where("(marketing_withdrawal.status='New' OR marketing_withdrawal.status='Pending')");
        $this->db->where("marketing_withdrawal.marketing_id=marketing.id");
        $this->db->from("marketing_withdrawal, marketing");
        $this->db->order_by('date_requested', 'ASC');
        return  $this->db->get()->result();
    }

    // ############################################

    // All
    function make_query_list()
    {
        // $marketing_id = sess('mkt');

        $this->db->select("marketing_withdrawal.*, marketing.nama, marketing.kode as kode_sales");
        // $this->db->where("marketing_withdrawal.marketing_id", $marketing_id);
        $this->db->where("(marketing_withdrawal.status='New' OR marketing_withdrawal.status='Pending')");
        $this->db->where("marketing_withdrawal.marketing_id=marketing.id");
        $this->db->from("marketing_withdrawal, marketing");

        $column_search = array('marketing_withdrawal.kode', 'amount_kotor', 'amount_bersih', 'marketing_withdrawal.status', 'marketing.nama', 'marketing.kode');
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
            $order_column = array(null, null, null, null, 'date_requested');
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("date_requested", "DESC");
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
}
