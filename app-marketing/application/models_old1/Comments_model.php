<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comments_model extends CI_Model
{

    public $table = 'comments';
    public $id = 'id_comments';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
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

  
    function get_by_id_blog($id,$status ='approved')
    {
        $this->db->where('blog_id', $id);
        $this->db->where('status',$status);
        return $this->db->get($this->table)->result();
    }

    function get_count_by_id_blog($id,$status ='approved')
    {
        $this->db->where('blog_id', $id)->count_all_results($this->table);
        $this->db->where('status',$status);
        return $this->db->where('blog_id', $id)->count_all_results($this->table);
    }

    // get data by id
    function get_by_id_asli($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_comments', $q);
    	$this->db->or_like('id_comments', $q);
    	$this->db->or_like('blog_id', $q);
    	$this->db->or_like('fullname', $q);
    	$this->db->or_like('email', $q);
    	$this->db->or_like('content_comment', $q);
    	$this->db->or_like('created_at', $q);
    	$this->db->or_like('status', $q);
    	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_comments', $q);
    	$this->db->or_like('id_comments', $q);
    	$this->db->or_like('blog_id', $q);
    	$this->db->or_like('fullname', $q);
    	$this->db->or_like('email', $q);
    	$this->db->or_like('content_comment', $q);
    	$this->db->or_like('created_at', $q);
    	$this->db->or_like('status', $q);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    public function get_commentsblog($id = TRUE) // join tabel comments & blogs
    {
        $query = "SELECT blog.judul, comments.content_comment, comments.fullname 
                FROM blog 
                INNER JOIN comments 
                ON blog.id_comments = comments.id_comments";
       /* if ($blog_id === FALSE) {
            return $query = $this->db->get('blog')->result();
        }
        $this->db->SELECT('*');
        $this->db->FROM('blog');
        $this->db->join('comments', 'comments.id_comments=blog.id_comments');
        $this->db->where('blog.blog_id',$id);
        return $this->db->get()->row_array();*/
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
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
//check pk data is exists 

        function is_exist($id){
         $query = $this->db->get_where($this->table, array($this->id => $id));
         $count = $query->num_rows();
         if($count > 0){
            return true;
         }else{
            return false;
         }
        }


}

/* End of file Comments_model.php */
/* Location: ./application/models/Comments_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-03-09 04:20:39 */
/* http://harviacode.com */