<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_model extends CI_Model
{


    // ############################################

    // All
    function make_query_team()
    {
        $marketing_id = sess('mkt');

        $this->db->select("marketing.*, marketing_role.role, (SELECT name FROM wil_kabupaten WHERE wil_kabupaten.id=marketing.id_kabupaten) AS kota_asal");
        $this->db->where("marketing.parent_id", $marketing_id);
        $this->db->where("marketing.is_deleted", "0");
        $this->db->where("marketing.role_id=marketing_role.id");
        $this->db->from("marketing, marketing_role");

        $column_search = array('nama', 'email', 'no_hp', 'role');
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
            $order_column = array(null, null, 'marketing_role.role', null, null);
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("date_added", "DESC");
        }
    }
    function make_datatables_team()
    {
        $this->make_query_team();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_team()
    {
        $this->make_query_team();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_team()
    {
        $this->make_query_team();
        return $this->db->count_all_results();
    }
}
