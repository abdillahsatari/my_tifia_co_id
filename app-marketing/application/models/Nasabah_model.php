<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nasabah_model extends CI_Model
{

    public $table = 'nasabah';
    public $id = 'nasabah_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('nasabah_id,nama_lengkap,gender,no_hp,email,status,status_verify, created_date');
        $this->datatables->from('nasabah');
        $this->datatables->where('nasabah_role_id', '2');
        //add this line for join
        //$this->datatables->join('table2', 'nasabah.field = table2.field');
        // $this->datatables->add_column('action', anchor(site_url('adminarea/nasabah/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/nasabah/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')."  ".anchor(site_url('adminarea/nasabah/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'adminarea/nasabah/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'nasabah_id');
        // $this->datatables->add_column('action', anchor(site_url('adminarea/nasabah/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/nasabah/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"'), 'nasabah_id');
        $this->datatables->add_column('action', anchor(site_url('adminarea/nasabah/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/nasabah/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')."  ".anchor(site_url('adminarea/nasabah/perjanjian_nasabah/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-info" data-toggle="tooltip" title="Perjanjian Nasabah"'), 'nasabah_id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('nasabah_id', $q);
		$this->db->or_like('nama_lengkap', $q);
		$this->db->or_like('gender', $q);
		$this->db->or_like('no_hp', $q);
		$this->db->or_like('email', $q);
		$this->db->or_like('password', $q);
		$this->db->or_like('tempat_lahir', $q);
		$this->db->or_like('tgl_lahir', $q);
		$this->db->or_like('alamat_rumah', $q);
		$this->db->or_like('kode_pos', $q);
		$this->db->or_like('jenis_identitas', $q);
		$this->db->or_like('no_identitas', $q);
		$this->db->or_like('status_kawin', $q);
		$this->db->or_like('nama_pasangan', $q);
		$this->db->or_like('nama_ibu', $q);
		$this->db->or_like('no_tlp', $q);
		$this->db->or_like('no_faksimili', $q);
		$this->db->or_like('no_npwp', $q);
		$this->db->or_like('alamat_surat_menyurat', $q);
		$this->db->or_like('status_rumah', $q);
		$this->db->or_like('pengalaman_investasi', $q);
		$this->db->or_like('kewarganegaraan', $q);
		$this->db->or_like('tujuan_pembukaan_rek', $q);
		$this->db->or_like('keluarga_bapepti', $q);
		$this->db->or_like('status_pailit', $q);
		$this->db->or_like('nama_rekan', $q);
		$this->db->or_like('telepon_rekan', $q);
		$this->db->or_like('hubungan_rekan', $q);
		$this->db->or_like('alamat_rekan', $q);
		$this->db->or_like('kode_pos_rekan', $q);
		$this->db->or_like('pekerjaan', $q);
		$this->db->or_like('nama_perusahaan', $q);
		$this->db->or_like('bidang_usaha', $q);
		$this->db->or_like('jabatan', $q);
		$this->db->or_like('lama_kerja', $q);
		$this->db->or_like('alamat_kantor', $q);
		$this->db->or_like('kode_pos_kantor', $q);
		$this->db->or_like('telepon_kantor', $q);
		$this->db->or_like('faksimili_kantor', $q);
		$this->db->or_like('kantor_sebelumnya', $q);
		$this->db->or_like('pendapatan_pertahun', $q);
		$this->db->or_like('lokasi_rumah', $q);
		$this->db->or_like('njob', $q);
		$this->db->or_like('deposit_bank', $q);
		$this->db->or_like('jumlah_kekayaan', $q);
		$this->db->or_like('kekayaan_lainnya', $q);
		$this->db->or_like('pict_identitas', $q);
		$this->db->or_like('foto_terkini', $q);
		$this->db->or_like('jenis_dokumen_tambahan', $q);
		$this->db->or_like('dokumen_tambahan', $q);
		$this->db->or_like('perusahaan_simulasi', $q);
		$this->db->or_like('penyelesaian_perselisihan', $q);
		$this->db->or_like('daftar_kantor', $q);
		$this->db->or_like('status', $q);
		$this->db->or_like('status_verify', $q);
		$this->db->or_like('is_active', $q);
		$this->db->or_like('komentar', $q);
		$this->db->or_like('nasabah_role_id', $q);
		$this->db->or_like('created_date', $q);
		$this->db->or_like('user_id', $q);
		$this->db->or_like('update_date', $q);
		$this->db->or_like('update_user_id', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('nasabah_id', $q);
		$this->db->or_like('nama_lengkap', $q);
		$this->db->or_like('gender', $q);
		$this->db->or_like('no_hp', $q);
		$this->db->or_like('email', $q);
		$this->db->or_like('password', $q);
		$this->db->or_like('tempat_lahir', $q);
		$this->db->or_like('tgl_lahir', $q);
		$this->db->or_like('alamat_rumah', $q);
		$this->db->or_like('kode_pos', $q);
		$this->db->or_like('jenis_identitas', $q);
		$this->db->or_like('no_identitas', $q);
		$this->db->or_like('status_kawin', $q);
		$this->db->or_like('nama_pasangan', $q);
		$this->db->or_like('nama_ibu', $q);
		$this->db->or_like('no_tlp', $q);
		$this->db->or_like('no_faksimili', $q);
		$this->db->or_like('no_npwp', $q);
		$this->db->or_like('alamat_surat_menyurat', $q);
		$this->db->or_like('status_rumah', $q);
		$this->db->or_like('pengalaman_investasi', $q);
		$this->db->or_like('kewarganegaraan', $q);
		$this->db->or_like('tujuan_pembukaan_rek', $q);
		$this->db->or_like('keluarga_bapepti', $q);
		$this->db->or_like('status_pailit', $q);
		$this->db->or_like('nama_rekan', $q);
		$this->db->or_like('telepon_rekan', $q);
		$this->db->or_like('hubungan_rekan', $q);
		$this->db->or_like('alamat_rekan', $q);
		$this->db->or_like('kode_pos_rekan', $q);
		$this->db->or_like('pekerjaan', $q);
		$this->db->or_like('nama_perusahaan', $q);
		$this->db->or_like('bidang_usaha', $q);
		$this->db->or_like('jabatan', $q);
		$this->db->or_like('lama_kerja', $q);
		$this->db->or_like('alamat_kantor', $q);
		$this->db->or_like('kode_pos_kantor', $q);
		$this->db->or_like('telepon_kantor', $q);
		$this->db->or_like('faksimili_kantor', $q);
		$this->db->or_like('kantor_sebelumnya', $q);
		$this->db->or_like('pendapatan_pertahun', $q);
		$this->db->or_like('lokasi_rumah', $q);
		$this->db->or_like('njob', $q);
		$this->db->or_like('deposit_bank', $q);
		$this->db->or_like('jumlah_kekayaan', $q);
		$this->db->or_like('kekayaan_lainnya', $q);
		$this->db->or_like('pict_identitas', $q);
		$this->db->or_like('foto_terkini', $q);
		$this->db->or_like('jenis_dokumen_tambahan', $q);
		$this->db->or_like('dokumen_tambahan', $q);
		$this->db->or_like('perusahaan_simulasi', $q);
		$this->db->or_like('penyelesaian_perselisihan', $q);
		$this->db->or_like('daftar_kantor', $q);
		$this->db->or_like('status', $q);
		$this->db->or_like('status_verify', $q);
		$this->db->or_like('is_active', $q);
		$this->db->or_like('komentar', $q);
		$this->db->or_like('nasabah_role_id', $q);
		$this->db->or_like('created_date', $q);
		$this->db->or_like('user_id', $q);
		$this->db->or_like('update_date', $q);
		$this->db->or_like('update_user_id', $q);
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete bulkdata
    function deletebulk(){
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data); 
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }

    public function getdata($key, $value) {
    	$this->db->select('*');
    	$this->db->from($this->table);
    	$this->db->where($key, $value);
    	return $this->db->get();
    }

    public function gettoken($value) {
    	$this->db->select('*');
    	$this->db->from('nasabah_token');
    	$this->db->where('email', $value);
    	return $this->db->get();
    }

    function deletetoken($email)
    {
        $this->db->where('email', $email);
        $this->db->delete('nasabah_token');
    }

    function get_join_bank($id)
    {
    	$this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('bank', 'bank.nasabah_id='.$this->table.'.nasabah_id');
        $this->db->where($this->table.'.nasabah_id', $id);
        $this->db->order_by($this->table.'.'.$this->id, $this->order);
        return $this->db->get();
    }

    function get_count()
    {
        $query = $this->db->get($this->table);
        if($query->num_rows()>0) {
          return $query->num_rows();
        }
        else
        {
          return 0;
        }
	}
	
	function get_count_email_notverify()
	{
		return $this->db->select("*")
						->from($this->table)
						->where('status_verify', 'T')
						->count_all_results();
	}
	
	function get_count_register()
	{
		return $this->db->select("*")
						->from($this->table)
						->where('status', 'Register')
						->count_all_results();
	}
	
	function get_count_complete_register()
	{
		return $this->db->select("*")
						->from($this->table)
						->where('status', 'Complete')
						->count_all_results();
						// return 0;
	}
}

/* End of file Nasabah_model.php */
/* Location: ./application/models/Nasabah_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-03 11:53:32 */
/* http://harviacode.com */