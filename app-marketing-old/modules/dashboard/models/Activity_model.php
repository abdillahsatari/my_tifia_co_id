<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activity_model extends CI_Model
{

    function nasabah_by_marketingID($marketing_id)
    {
        $this->db->select("nama, id, kode");
        $this->db->from("calon_nasabah");
        $this->db->where("marketing_id", $marketing_id);
        $this->db->order_by('date_added', 'ASC');
        return  $this->db->get()->result();
    }

    // ############################################

    // All
    function make_query_activity()
    {
        $marketing_id = sess('mkt');

        $this->db->select("marketing_activity.*, calon_nasabah.nama");
        $this->db->where("marketing_activity.calon_nasabah_id = calon_nasabah.id");
        $this->db->where("marketing_activity.marketing_id", $marketing_id);
        $this->db->where("marketing_activity.is_deleted", "0");
        $this->db->from("marketing_activity,calon_nasabah");

        $column_search = array('marketing_activity.kode', 'marketing_activity.prioritas', 'marketing_activity.kategori');
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
    function make_datatables_activity()
    {
        $this->make_query_activity();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_activity()
    {
        $this->make_query_activity();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_activity()
    {
        $this->make_query_activity();
        return $this->db->count_all_results();
    }
}
