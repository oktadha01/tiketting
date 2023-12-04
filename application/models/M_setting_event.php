<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_setting_event extends CI_Model
{
    // function m_data_laporan($id_map, $status, $tgl_start, $tgl_end)
    function m_data_admin()
    {
        $this->db->select('*');
        $this->db->from('admin');
        $query = $this->db->get();
        return $query->result();
    }
    function m_get_perum()
    {
        $this->db->select('*');
        $this->db->from('perumahan');
        $query = $this->db->get();
        return $query->result();
    }
}
