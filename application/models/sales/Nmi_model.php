<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nmi_model extends CI_Model
{

    // All
    function make_query_list($status = '')
    {
        $this->db->select("marketing_nmi.*, marketing.nama as nama_sales, marketing.kode as kode_sales");
        $this->db->where("marketing_nmi.marketing_id=marketing.id");
        $this->db->from("marketing_nmi, marketing");

        if (!empty($status) || $status != '') {
            if (is_array($status)) {
                foreach ($status as $stat) {
                    if ($stat == $status[0]) $this->db->where('marketing_nmi.status', $stat);
                    else $this->db->or_where('marketing_nmi.status', $stat);
                }
            } else {
                $this->db->where('marketing_nmi.status', $status);
            }
        }

        $column_search = array('marketing.kode', 'marketing.nama', 'marketing_nmi.status', 'marketing_nmi.kode', 'marketing_nmi.deskripsi', 'marketing_nmi.grand_total');
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
    function make_datatables_list($status)
    {
        $this->make_query_list($status);
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_list($status)
    {
        $this->make_query_list($status);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_list($status)
    {
        $this->make_query_list($status);
        return $this->db->count_all_results();
    }
}
