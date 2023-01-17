<?php
defined('BASEPATH') or exit('No direct script access allowed');

class All_sales_model extends CI_Model
{

    function get_all()
    {
        $this->db->select(" marketing.*,
                            (SELECT name FROM wil_provinsi WHERE wil_provinsi.id=marketing.id_provinsi) AS provinsi,
                            (SELECT name FROM wil_kabupaten WHERE wil_kabupaten.id=marketing.id_kabupaten) AS kabupaten,
                            (SELECT name FROM wil_kecamatan WHERE wil_kecamatan.id=marketing.id_kecamatan) AS kecamatan,
                            (SELECT name FROM wil_kelurahan WHERE wil_kelurahan.id=marketing.id_kelurahan) AS kelurahan
                        ");
        $this->db->where("marketing.is_deleted", "0");
        $this->db->from("marketing");
        $this->db->order_by('date_added', 'ASC');
        return  $this->db->get()->result();
    }

    function get_role()
    {
        $this->db->select("*");
        $this->db->from("marketing_role");
        $this->db->where('id != 1');
        $this->db->order_by('id', 'ASC');
        return  $this->db->get()->result();
    }

    // ############################################

    // All
    function make_query_team()
    {
        $this->db->select("marketing.*, marketing_role.role, (SELECT name FROM wil_kabupaten WHERE wil_kabupaten.id=marketing.id_kabupaten) AS kota_asal");
        $this->db->where("marketing.is_deleted", "0");
        $this->db->where('marketing.role_id != 1');
        $this->db->where("marketing.role_id=marketing_role.id");
        $this->db->from("marketing, marketing_role");

        $column_search = array('kode', 'nama', 'email', 'no_hp', 'role');
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
            $order_column = array(null, null, 'role', null, null);
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
