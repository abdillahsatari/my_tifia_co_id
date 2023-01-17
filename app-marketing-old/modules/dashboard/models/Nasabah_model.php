<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah_model extends CI_Model
{


    // ############################################

    // Semua Nasabah
    function make_query_list()
    {
        $marketing_id = sess('mkt');

        $this->db->select("calon_nasabah.*, (SELECT name FROM wil_kabupaten WHERE wil_kabupaten.id=calon_nasabah.id_kabupaten) AS kota_asal");
        $this->db->where("calon_nasabah.marketing_id", $marketing_id);
        $this->db->where("calon_nasabah.is_deleted", "0");
        $this->db->from("calon_nasabah");

        $column_search = array('kode', 'nama', 'email', 'no_hp');
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

    // Semua Transaksi Nasabah
    function make_query_semua_transaksi()
    {
        $marketing_id = sess('mkt');

        $this->db->select("calon_nasabah.*, (SELECT name FROM wil_kabupaten WHERE wil_kabupaten.id=calon_nasabah.id_kabupaten) AS kota_asal");
        $this->db->where("calon_nasabah.marketing_id", $marketing_id);
        $this->db->where("calon_nasabah.is_deleted", "0");
        $this->db->from("calon_nasabah");

        $column_search = array('kode', 'nama', 'email', 'no_hp');
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
    function make_datatables_semua_transaksi()
    {
        $this->make_query_semua_transaksi();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data_semua_transaksi()
    {
        $this->make_query_semua_transaksi();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data_semua_transaksi()
    {
        $this->make_query_semua_transaksi();
        return $this->db->count_all_results();
    }
}
