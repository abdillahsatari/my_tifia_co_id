<?php
defined('BASEPATH') or exit('No direct script access allowed');

class All_referral_model extends CI_Model
{
    function get_all()
    {
        $this->db->select("nasabah.*, marketing.id as marketing_id, marketing.nama as nama_sales, marketing.kode as kode_sales");
        $this->db->where("nasabah.parent_id=marketing.id");
        $this->db->where("nasabah.is_active", "1");
        $this->db->from("nasabah, marketing");
        $this->db->order_by('date_added', 'ASC');
        return  $this->db->get()->result();
    }

    function array_akun_real($nasabah_id)
    {
        $output = [];

        $this->db->select("no_akun");
        $this->db->from("acc_trading");
        $this->db->where("nasabah_id", $nasabah_id);
        $this->db->order_by('tanggal_buat_akun', 'ASC');
        $variable =  $this->db->get()->result();

        foreach ($variable as $r) {
            array_push($output, $r->no_akun);
        }

        return $output;

        // tampilkan dengan
        // implode(",", $array);
    }

    function get_akun_real($nasabah_id)
    {
        $output = '<ul class="mb-0" style="font-size: 0.9rem;">';

        $this->db->select("no_akun");
        $this->db->from("acc_trading");
        $this->db->where("nasabah_id", $nasabah_id);
        $this->db->order_by('tanggal_buat_akun', 'ASC');
        $variable =  $this->db->get()->result();

        foreach ($variable as $r) {
            $output .= '<li>' . $r->no_akun . '</li>';
        }

        $output .= '</ul>';

        return $output;
    }


    // ############################################

    // All
    function make_query_list()
    {
        $this->db->select("nasabah.*, marketing.id as marketing_id, marketing.nama as nama_sales, marketing.kode as kode_sales");
        $this->db->where("nasabah.parent_id=marketing.id");
        $this->db->where("nasabah.parent_id!=1");
        $this->db->where("nasabah.is_active", "1");
        $this->db->from("nasabah, marketing");

        $column_search = array('nasabah.nama_lengkap', 'nasabah.email', 'nasabah.no_hp', 'nasabah.status', 'marketing.kode', 'marketing.nama');
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
            $this->db->order_by("created_date", "DESC");
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
