<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog_model extends CI_Model
{

    public $table = 'blog';
    public $id = 'blog_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('blog_id,gambar,judul,content,status,blog.date as tgl,blog_kategori');
        $this->datatables->from('blog');
        $this->datatables->join('blog_kategori', 'blog.blog_kategori_id=blog_kategori.blog_kategori_id');
        //add this line for join
        //$this->datatables->join('table2', 'blog.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('adminarea/blog/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"')."  ".anchor(site_url('adminarea/blog/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')."  ".anchor(site_url('adminarea/blog/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'blog/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'blog_id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->row_array();
    }

    

    function get_all_query() {
        $sql = "SELECT b.blog_id,b.gambar,b.judul,b.content,b.status,b.slug,b.date as tgl,c.blog_kategori FROM blog b JOIN blog_kategori c ON b.blog_kategori_id=c.blog_kategori_id ORDER BY blog_id DESC LIMIT 3";
        return $this->db->query($sql)->result();
    }

    function get_all_query_sitemap() {
        $sql = "SELECT b.blog_id,b.gambar,b.judul,b.content,b.status,b.slug,b.date as tgl,c.blog_kategori FROM blog b JOIN blog_kategori c ON b.blog_kategori_id=c.blog_kategori_id ORDER BY blog_id";
        return $this->db->query($sql)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('blog_id', $q);
	$this->db->or_like('blog_kategori_id', $q);
	$this->db->or_like('gambar', $q);
	$this->db->or_like('judul', $q);
	$this->db->or_like('content', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('date', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('blog_id', $q);
	$this->db->or_like('blog_kategori_id', $q);
	$this->db->or_like('gambar', $q);
	$this->db->or_like('judul', $q);
	$this->db->or_like('content', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('date', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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

    function data($number,$offset){
        return $query = $this->db->get('blog',$number,$offset)->result();       
    }

    function rows() {
        return $this->db->query("SELECT * FROM blog WHERE status = 'Aktif'")->num_rows();
    }

    function view() {
        $this->load->library('pagination'); // Load librari paginationnya
        
        $query = "SELECT * FROM blog where status = 'Aktif' ORDER BY blog_id DESC"; // Query untuk menampilkan semua data siswa
        
        $config['base_url'] = base_url('content/blog/lists');
        $config['total_rows'] = $this->db->query($query)->num_rows();
        $config['per_page'] = 6;
        $config['uri_segment'] = 4;
        $config['num_links'] = 3;


        
        // Style Pagination
        // Agar bisa mengganti stylenya sesuai class2 yg ada di bootstrap
        $config['full_tag_open']   = '<ul class="pagination float-right">';
        $config['full_tag_close']  = '</ul>';
        
        $config['first_link']      = 'First'; 
        $config['first_tag_open']  = '<li class="page-link"> <a class="page-link">';
        $config['first_tag_close'] = '</li> </a>';
        
        $config['last_link']       = 'Last'; 
        $config['last_tag_open']   = '<a class="page-link"><li>';
        $config['last_tag_close']  = '</li></a>';
        
        $config['next_link']       = '<a class="page-link"> <i class="fas fa-angle-right"></i> </a>'; 
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        
        $config['prev_link']       = '<a class="page-link"><i class="fas fa-angle-left"></i></a>'; 
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        
        $config['cur_tag_open']    = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']   = '</a></li>';
         
        $config['num_tag_open']    = '<li class="page-item"> <a class="page-link"';
        $config['num_tag_close']   = '</a></li>';

       /* <ul class="pagination float-right">
                        <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
                    </ul>*/
        // End style pagination
        
        $this->pagination->initialize($config); // Set konfigurasi paginationnya
        
        $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
        $query .= " LIMIT ".$page.", ".$config['per_page'];
        
        $data['limit'] = $config['per_page'];
        $data['total_rows'] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links(); // Generate link pagination nya sesuai config diatas
        $data['blog'] = $this->db->query($query)->result();
        
        return $data;
    }

    public function getBlogs_detail($slug = FALSE, $id = TRUE){

        #jika tidak ada slug/parameter $1 yang di routes maka akan di tampilkan controller blogs
        if ($slug === FALSE) {
        
            return $query = $this->db->get('blog')->result();

        }
        # mengambil parameter di dalam tabel news yaitu slug
        # slug = nama kolom di tabel news
        $this->db->SELECT('*');
        $this->db->FROM('blog');
        $this->db->where('blog.slug',$slug,$id);
        return $this->db->get()->row_array();

        /*$query = $this->db->get_where('blogs',array('slug' => $slug ));
        return $query->row_array();*/
    }

    public function getBlogs_id($id = FALSE)

    {

        $query = $this->db->get_where('blog',array('blog_id' => $id ));
        return $query->row_array();

    }

    public function updateView($slug, $jml) {
        $this->db->where('slug', $slug);
        $this->db->update($this->table, $jml);
    }

    public function popularArtikel() {
        $this->db->select('blog_id, slug, judul');
        $this->db->from($this->table);
        $this->db->order_by('view', 'DESC');
        $this->db->limit('3');
        return $this->db->get()->result();
    }

}

/* End of file Blog_model.php */
/* Location: ./application/models/Blog_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-02-25 14:31:02 */
/* http://harviacode.com */