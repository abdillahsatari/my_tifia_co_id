<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plan_model extends CI_Model
{


    // ############################################

    // All
    function make_query_plan()
    {
        $marketing_id = sess('mkt');

        $this->db->select("*");
        $this->db->where("marketing_planning.marketing_id", $marketing_id);
        $this->db->where("marketing_planning.is_deleted", "0");
        $this->db->from("marketing_planning");

        $column_search = array('bulan', 'tahun', 'target_omset', 'judul', 'kode');
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
            $this->db->order_by("date_added", "DESC");
        }
    }
    function make_datatables_plan()
    {
        $this->make_query_plan();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_plan()
    {
        $this->make_query_plan();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_plan()
    {
        $this->make_query_plan();
        return $this->db->count_all_results();
    }
}
