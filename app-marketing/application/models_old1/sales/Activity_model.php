<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activity_model extends CI_Model
{

    function marketing_by_id($id, $field = '*')
    {
        return $this->db->query("SELECT $field FROM marketing WHERE id='$id'")->row_array();
    }

    function nasabah_by_marketingID($marketing_id)
    {
        $this->db->select("nama, id, kode");
        $this->db->from("calon_nasabah");
        $this->db->where("marketing_id", $marketing_id);
        $this->db->order_by('date_added', 'ASC');
        return  $this->db->get()->result();
    }

    function get_all()
    {
        $this->db->select("marketing_activity.*, calon_nasabah.nama, marketing.nama as nama_sales, marketing.kode as kode_sales, calon_nasabah.kode as kode_nasabah");
        $this->db->where("marketing_activity.calon_nasabah_id = calon_nasabah.id");
        $this->db->where("marketing_activity.is_deleted", "0");
        $this->db->where("marketing_activity.marketing_id=marketing.id");
        $this->db->from("marketing_activity, calon_nasabah, marketing");
        $this->db->order_by('date_added', 'ASC');
        return  $this->db->get()->result();
    }

    // ############################################

    // All
    function make_query_activity()
    {
        // $marketing_id = sess('mkt');

        $this->db->select("marketing_activity.*, calon_nasabah.nama, marketing.nama as nama_sales, marketing.kode as kode_sales, calon_nasabah.kode as kode_nasabah");
        $this->db->where("marketing_activity.calon_nasabah_id = calon_nasabah.id");
        $this->db->where("marketing_activity.is_deleted", "0");
        $this->db->where("marketing_activity.marketing_id=marketing.id");

        if ($this->input->post('daterangepicker_start') && $this->input->post('daterangepicker_end')) {

            $daterangepicker_start = $this->input->post('daterangepicker_start') . ' 00:00:00';
            $daterangepicker_end = $this->input->post('daterangepicker_end') . ' 23:59:59';

            $this->db->where("marketing_activity.date_added >= '$daterangepicker_start'");
            $this->db->where("marketing_activity.date_added <= '$daterangepicker_end'");
        }

        $this->db->from("marketing_activity, calon_nasabah, marketing");

        $column_search = array('marketing_activity.kode', 'marketing_activity.prioritas', 'marketing_activity.kategori', 'marketing.kode', 'marketing.nama', 'calon_nasabah.nama', 'calon_nasabah.kode');
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
