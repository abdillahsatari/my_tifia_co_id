<?php
defined('BASEPATH') or exit('No direct script access allowed');

class All_nasabah_model extends CI_Model
{

    function get_all()
    {
        $this->db->select("calon_nasabah.*, marketing.nama as nama_sales, marketing.kode as kode_sales,
            (SELECT name FROM wil_provinsi WHERE wil_provinsi.id=calon_nasabah.id_provinsi) AS provinsi,
            (SELECT name FROM wil_kabupaten WHERE wil_kabupaten.id=calon_nasabah.id_kabupaten) AS kabupaten,
            (SELECT name FROM wil_kecamatan WHERE wil_kecamatan.id=calon_nasabah.id_kecamatan) AS kecamatan,
            (SELECT name FROM wil_kelurahan WHERE wil_kelurahan.id=calon_nasabah.id_kelurahan) AS kelurahan");
        $this->db->where("calon_nasabah.marketing_id=marketing.id");
        $this->db->where("calon_nasabah.is_deleted", "0");
        $this->db->from("calon_nasabah, marketing");
        $this->db->order_by('date_added', 'ASC');
        return  $this->db->get()->result();
    }

    // ############################################

    // All
    function make_query_list()
    {
        $this->db->select("calon_nasabah.*, marketing.nama as nama_sales, marketing.kode as kode_sales, (SELECT name FROM wil_kabupaten WHERE wil_kabupaten.id=calon_nasabah.id_kabupaten) AS kota_asal");
        $this->db->where("calon_nasabah.marketing_id=marketing.id");
        $this->db->where("calon_nasabah.is_deleted", "0");
        $this->db->from("calon_nasabah, marketing");

        $column_search = array('calon_nasabah.kode', 'calon_nasabah.nama', 'calon_nasabah.email', 'calon_nasabah.no_hp', 'marketing.kode', 'marketing.nama');
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
