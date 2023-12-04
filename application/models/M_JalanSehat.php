<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_JalanSehat extends CI_Model
{

    // start datatables
    var $column_order = array(null, 'nama', 'desa', 'kategori', 'no_undian'); //set column field database for datatable orderable
    var $column_search = array('nama', 'desa', 'kategori', 'no_undian'); //set column field database for datatable searchable
    var $order = array('id_warga' => 'asc'); // default order

    private function _get_datatables_query() {
        $this->db->select('*');
        $this->db->from('jalan_sehat');
        $i = 0;
        foreach ($this->column_search as $item) { // loop column
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all() {
        $this->db->from('jalan_sehat');
        return $this->db->count_all_results();
    }
    // end datatables

    function getChart()
    {
        $query = $this->db->query("
            SELECT
                desa,
                SUM(kategori = 'Dewasa') AS jumlah_dewasa,
                SUM(kategori = 'Anak-anak') AS jumlah_anak_anak
            FROM
                jalan_sehat
            GROUP BY
                desa
        ");

        return $query->result();
    }

    function get_desa()
    {
        $this->db->select('*');
        $this->db->from('jalan_sehat');
        $this->db->group_by('desa');
        $query = $this->db->get();
        return $query->result();
    }

    function k_dewasa()
    {
        $this->db->select('COUNT(*) as jumlah_dewasa');
        $this->db->from('jalan_sehat');
        $this->db->where('desa', 'Kalisidi');
        $this->db->where('kategori', 'Dewasa');
        $query = $this->db->get();

        $result = $query->row();
        return $result->jumlah_dewasa;
    }
    function ke_dewasa()
    {
        $this->db->select('COUNT(*) as jumlah_dewasa');
        $this->db->from('jalan_sehat');
        $this->db->where('desa', 'keji');
        $this->db->where('kategori', 'Dewasa');
        $query = $this->db->get();

        $result = $query->row();
        return $result->jumlah_dewasa;
    }
    function la_dewasa()
    {
        $this->db->select('COUNT(*) as jumlah_dewasa');
        $this->db->from('jalan_sehat');
        $this->db->where('desa', 'Lainnya');
        $this->db->where('kategori', 'Dewasa');
        $query = $this->db->get();

        $result = $query->row();
        return $result->jumlah_dewasa;
    }

    function k_anak()
    {
        $this->db->select('COUNT(*) as jumlah_anak');
        $this->db->from('jalan_sehat');
        $this->db->where('desa', 'Kalisidi');
        $this->db->where('kategori', 'anak-anak');
        $query = $this->db->get();

        $result = $query->row();
        return $result->jumlah_anak;
    }

    function ke_anak()
    {
        $this->db->select('COUNT(*) as jumlah_anak');
        $this->db->from('jalan_sehat');
        $this->db->where('desa', 'keji');
        $this->db->where('kategori', 'anak-anak');
        $query = $this->db->get();

        $result = $query->row();
        return $result->jumlah_anak;
    }

    function la_anak()
    {
        $this->db->select('COUNT(*) as jumlah_anak');
        $this->db->from('jalan_sehat');
        $this->db->where('desa', 'Lainnya');
        $this->db->where('kategori', 'anak-anak');
        $query = $this->db->get();

        $result = $query->row();
        return $result->jumlah_anak;
    }

    public function get_total_peserta()
    {
            return $this->db->count_all_results('jalan_sehat');

    }

    public function get_filtered_peserta($limit, $offset, $order_column, $order_dir)
    {
            $this->db->select('nama, desa, kategori, no_hp');
            $this->db->from('jalan_sehat');
            $this->db->order_by($order_column, $order_dir);
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            return $query->result();

    }

}