<?php 
class Artikel_Model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function getArtikel($key=null, $value=null) {
        if ($key!=null) {
            $this->db->select('blog_id, judul, content, gambar, blog.date as date, blog.blog_kategori_id, nama_kategori');
            $this->db->from('blog');
            $this->db->join('blog_kategori', 'blog_kategori.blog_kategori_id=blog.blog_kategori_id');
            $this->db->where(array($key => $value));
            return $this->db->get()->row_array();
        } else {
            $this->db->select('blog_id, judul, blog.date as date, nama_kategori, gambar, content');
            $this->db->from('blog');
            $this->db->join('blog_kategori', 'blog_kategori.blog_kategori_id=blog.blog_kategori_id');
            $this->db->order_by('blog.date', 'DESC');
            $this->db->limit('3');
            return $this->db->get()->result();
        }
    }
}

