<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kit_model extends CI_Model
{

    // All
    function make_query_list($tipe)
    {
        $this->db->select("*");
        $this->db->where("tipe", $tipe);
        $this->db->from("marketing_kit");

        $column_search = array('nama', 'deskripsi', 'jenis');
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
    function make_datatables_list($tipe)
    {
        $this->make_query_list($tipe);
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_list($tipe)
    {
        $this->make_query_list($tipe);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_list($tipe)
    {
        $this->make_query_list($tipe);
        return $this->db->count_all_results();
    }
}
