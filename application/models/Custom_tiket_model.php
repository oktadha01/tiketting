<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_tiket_model extends CI_Model
{

    public function get_datacustom($id_event)
    {
        $this->db->select('*');
        $this->db->from('custom_tiket');
        $this->db->where('id_event', $id_event);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_color_by_id_event($id_event) {
        $this->db->select('id_event, color_nama, color_email, color_kategori, color_code_tiket');
        $this->db->where('id_event', $id_event);
        return $this->db->get('custom_tiket')->row_array();
    }


    function save_design($data) {
        return $this->db->insert('custom_tiket', $data);
    }

    function update_design($id_event, $data)
    {
        $this->db->where('id_event', $id_event);
        return $this->db->update('custom_tiket', $data);
    }

}