<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Acc_demo_request_model extends CI_Model
{
    public $table = 'acc_request';
    public $id = 'acc_request_id';
    public $order = 'DESC';

    // get all
    function get_all()
    {
        // $this->db->order_by($this->id, $this->order);
        // return $this->db->get($this->table)->result();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('nasabah', 'acc_request.nasabah_id = nasabah.nasabah_id');
        $this->db->join('acc_type', 'acc_request.acc_type_id = acc_type.acc_type_id');
        $this->db->join('acc_currency', 'acc_request.acc_currency_id = acc_currency.acc_currency_id', 'left');
        $this->db->join('acc_leverage', 'acc_request.acc_leverage_id = acc_leverage.acc_leverage_id', 'left');
        $this->db->where('acc_type_id', '1');
        return $this->db->get()->result();
    }

    function get_by_id_join($id)
    {
        $this->db->select('*, acc_request.date AS date_request');
        $this->db->from($this->table);
        $this->db->join('nasabah', 'acc_request.nasabah_id = nasabah.nasabah_id');
        $this->db->join('acc_type', 'acc_request.acc_type_id = acc_type.acc_type_id');
        $this->db->join('acc_currency', 'acc_request.acc_currency_id = acc_currency.acc_currency_id', 'left');
        $this->db->join('acc_leverage', 'acc_request.acc_leverage_id = acc_leverage.acc_leverage_id', 'left');
        $this->db->where($this->id, $id);
        return $this->db->get()->row();
    }

    // ############################################

    // All
    function make_query_list()
    {
        // $marketing_id = sess('mkt');

        $this->db->select('acc_request_id, nama_lengkap, email, type, acc_request.date as tanggal_request, status_request');
        // $this->datatables->select('acc_request_id, acc_request.date as tanggal_request');
        $this->db->from('acc_request');
        $this->db->join('acc_type', 'acc_request.acc_type_id = acc_type.acc_type_id');
        $this->db->join('nasabah', 'acc_request.nasabah_id = nasabah.nasabah_id');
        $this->db->where("status_request", "Dikonfirmasi");
        $this->db->where("jenis", "Demo");

        $column_search = array('no_akun', 'status_request', 'status_aktif');
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
            $order_column = array(null, null, null, null, 'date_requested');
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by("acc_request.date", "DESC");
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
