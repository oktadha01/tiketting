<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_tiket_model extends CI_Model
{

    public function update_data($table, $data, $id_banner) {
        $this->db->where('id_banner', $id_banner);
        return $this->db->update($table, $data);
    }

    function save_backround($data) {
        return $this->db->insert('custom_tiket', $data);
    }

}