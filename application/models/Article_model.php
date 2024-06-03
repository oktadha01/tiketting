<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model
{

    public function get_data_artikel($limit, $start, $search = '')
    {
        {
            $this->db->select('article.*, content_article.id_article AS id_content_article, content_article.id_content, content_article.content');
            $this->db->from('article');
            $this->db->join('content_article', 'content_article.id_article = article.id_article', 'left');

            if (!empty($search)) {
                $this->db->like('judul_article', $search);
            }

            $this->db->group_by('article.id_article');
            $this->db->order_by("article.id_article", "DESC");
            $this->db->limit($limit, $start);
            $query = $this->db->get();

            return $query;
        }
    }


    function get_data_tag()
    {
        $this->db->select('tags');
        $this->db->from('article');
        $this->db->group_by('tags');
        $this->db->order_by('tags', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function save_article($data) {
        return $this->db->insert('article', $data);
    }

    function save_content($data) {
        return $this->db->insert('content_article', $data);
    }

    public function update_data($table, $data, $id_article) {
        $this->db->where('id_article', $id_article);
        return $this->db->update($table, $data);
    }

    public function update_content($table, $data, $id_content) {
        $this->db->where('id_content', $id_content);
        return $this->db->update($table, $data);
    }

    public function get_article_data($article_id) {
        $query = $this->db->get_where('article', array('id_article' => $article_id));
        return $query->row_array();
    }

    function get_gbr_content($id_content)
    {
        $this->db->select('*');
        $this->db->from('foto_content');
        $this->db->where('id_content', $id_content);
        $query = $this->db->get();

        return $query->result();
    }

    function tambah_gambar($data) {
        return $this->db->insert('foto_content', $data);
    }

    public function hapus_gambar($id_gambar)
    {
        $this->db->where('id_foto_content', $id_gambar);
        $this->db->delete('foto_content');

        return $this->db->affected_rows() > 0;
    }

    public function get_gambar_data($id_gambar) {
        $query = $this->db->get_where('foto_content', array('id_foto_content' => $id_gambar));
        return $query->row_array();
    }

    public function get_article($id_article) {
        $query = $this->db->get_where('content_article', array('id_article' => $id_article));
        return $query->row_array();
    }

    // data popular post
    public function get_popular_post($limit, $start)
    {
        $this->db->select('article.*');
        $this->db->from('article');
        $this->db->order_by("article.views", "DESC");
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        return $query;

    }

    public function get_tags()
    {
        $this->db->select('tags');
        $this->db->distinct();
        $this->db->from('article');
        $query = $this->db->get();

        return $query;
    }

    function data_event_ready()
    {
        $this->db->select('combined_query.*');
        $this->db->from('(SELECT event.*, wilayah_kabupaten.*, MIN(price.harga) as min_price
                        FROM event
                        JOIN wilayah_kabupaten ON wilayah_kabupaten.id = event.kota
                        JOIN price ON price.id_event = event.id_event
                        WHERE price.stock_tiket >= (price.beli + price.gratis + price.tiket_bundling)
                        GROUP BY event.id_event
                        UNION
                        SELECT event.*, wilayah_kabupaten.*, MIN(price.harga) as min_price
                        FROM event
                        JOIN wilayah_kabupaten ON wilayah_kabupaten.id = event.kota
                        JOIN price ON price.id_event = event.id_event
                        GROUP BY event.id_event
                        ) AS combined_query');
        $this->db->group_by('combined_query.id_event');
        $this->db->order_by('combined_query.tgl_event', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->result();
    }

    public function get_tags_artikel($limit, $start, $tags_article)
    {
            $this->db->select('article.*');
            $this->db->from('article');
            $this->db->where('article.tags', $tags_article);
            $this->db->limit($limit, $start);
            $query = $this->db->get();

            return $query;
    }

    public function get_detail_artikel($limit, $start, $judul_article)
    {
            $this->db->select('*');
            $this->db->from('article');
            $this->db->where('article.judul_article', $judul_article);
            $this->db->limit($limit, $start);
            $query = $this->db->get();

            return $query;
    }

    public function get_foto_berita()
    {
            $this->db->select('*');
            $this->db->from('foto_content');
            $query = $this->db->get();

            return $query;
    }

    public function get_data_content()
    {
        $this->db->select('*');
        $this->db->from('content_article');
        $query = $this->db->get();

        return $query;
    }



}