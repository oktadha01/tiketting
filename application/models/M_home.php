<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model
{

    function data_event()
    {
        $this->db->select('*');
        $this->db->from('event');
        $this->db->join('wilayah_kabupaten', 'wilayah_kabupaten.id = event.kota');
        $this->db->limit(6);
        $this->db->order_by('id_event', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    function data_banner()
    {
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->order_by('id_banner', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

}