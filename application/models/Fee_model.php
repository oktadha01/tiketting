<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fee_model extends CI_Model
{

    public function get_event_menu($limit, $start, $search = '')
    {
        $this->db->select('event.*, internet_fee.id_fee, internet_fee.nominal, internet_fee.kategori, user.id_user, user.agency');
        $this->db->from('event');
        $this->db->join('internet_fee', 'internet_fee.id_event = event.id_event', 'left');
        $this->db->join('user', 'user.id_user = event.id_user');

        if (!empty($search)) {
            $this->db->like('event.nm_event', $search);
        }

        $this->db->order_by("event.id_event", "DESC");
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        return $query;
    }

    function save_fee($data) {
        return $this->db->insert('internet_fee', $data);
    }

    public function update_data($table, $data, $id_fee) {
        $this->db->where('id_fee', $id_fee);
        return $this->db->update($table, $data);
    }



}