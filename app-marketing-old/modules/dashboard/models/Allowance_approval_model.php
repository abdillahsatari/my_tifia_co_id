<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Allowance_approval_model extends CI_Model
{


    // ############################################

    // All
    function make_query_list()
    {
        // $marketing_id = sess('mkt');

        $this->db->select("marketing_allowance.*, marketing.kode as kode_sales, marketing.nama");
        $this->db->where("marketing_allowance.marketing_id=marketing.id");

        if ($this->input->post('daterangepicker_start') && $this->input->post('daterangepicker_end')) {

            $daterangepicker_start = $this->input->post('daterangepicker_start') . ' 00:00:00';
            $daterangepicker_end = $this->input->post('daterangepicker_end') . ' 23:59:59';

            $this->db->where("marketing_allowance.date_requested >= '$daterangepicker_start'");
            $this->db->where("marketing_allowance.date_requested <= '$daterangepicker_end'");
        }

        $this->db->from("marketing_allowance, marketing");

        $column_search = array('marketing.kode', 'marketing.nama', 'marketing_allowance.kode', 'marketing_allowance.amount_kotor', 'marketing_allowance.status');
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
