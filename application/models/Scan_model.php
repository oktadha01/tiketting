<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan_model extends CI_Model
{
    var $column_ordertrx = array(null, 'tiket.nama', 'tiket.gender', 'tiket.email', 'tiket.kontak');
    var $column_searchtrx = array('tiket.nama', 'tiket.gender', 'tiket.email', 'tiket.kontak', 'tiket.code_tiket');
    var $ordertrx = array('tiket.id_tiket' => 'asc');

    private function _get_datatables($id_event, $status_filter)
    {
        $this->db->select('*');
        $this->db->from('tiket');
        $this->db->join('event', 'event.id_event = tiket.id_event');
        $this->db->where('tiket.id_event', $id_event);
        $this->db->order_by('tiket.id_tiket', 'DESC');

        if ($status_filter !== '') {
            $this->db->where('tiket.status_tiket', $status_filter);
        }

        $i = 0;
        foreach ($this->column_searchtrx as $trx) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($trx, $_POST['search']['value']);
                } else {
                    $this->db->or_like($trx, $_POST['search']['value']);
                }
                if (count($this->column_searchtrx) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_ordertrx[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatablest($id_event, $status_filter)
    {
        $this->_get_datatables($id_event, $status_filter);
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtereds($id_event, $status_filter)
    {
        $this->_get_datatables($id_event, $status_filter);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all($id_event, $status_filter)
    {
        $this->_get_datatables($id_event, $status_filter);
        return $this->db->count_all_results();
    }

    function get_data_tiket($qrCodeMessage, $manualCode)
    {
        $this->db->select('*');
        $this->db->from('tiket');
        $this->db->where("(tiket.code_tiket = '$qrCodeMessage' OR tiket.code_tiket = '$manualCode')");
        $query = $this->db->get();
        return $query->result();
    }

    public function update_status_tiket($codeTiket)
    {
        $data = array('status_tiket' => 1);
        $this->db->where('code_tiket', $codeTiket);
        $this->db->update('tiket', $data);

        return array('success' => true);
    }

    public function get_event_menu($limit, $start, $search = '', $id_user, $privilage)
    {
        if ($privilage == 'Admin') {
            $this->db->select('event.*, user.id_user, user.agency');
            $this->db->from('event');
            $this->db->join('user', 'user.id_user = event.id_user');

            // Tambahkan kondisi pencarian jika ada
            if (!empty($search)) {
                $this->db->like('event.nm_event', $search);
            }

            $this->db->order_by("event.id_event", "DESC");
            $this->db->limit($limit, $start);
            $query = $this->db->get();

            return $query;
        } else if ($privilage == 'User') {

            $this->db->select('event.*, user.id_user, user.agency');
            $this->db->from('event');
            $this->db->join('user', 'user.id_user = event.id_user');
            $this->db->where('event.id_user', $id_user);

            if (!empty($search)) {
                $this->db->like('event.nm_event', $search);
            }

            $this->db->order_by("event.id_event", "DESC");
            $this->db->limit($limit, $start);
            $query = $this->db->get();

            return $query;
        }
    }

    public function get_total_tiket($id_user)
    {
        $this->db->select_sum('price.stock_tiket');
        $this->db->from('price');
        $this->db->join('event', 'event.id_event = price.id_event');
        $this->db->where('event.id_user', $id_user);

        $query = $this->db->get();
        return $query->row()->stock_tiket;
    }

    public function get_tiket_status($id_user)
    {
        $this->db->select('SUM(CASE WHEN status_tiket = 1 THEN 1 ELSE 0 END) as jumlah_tiket_1');
        $this->db->select('SUM(CASE WHEN status_tiket = 0 THEN 1 ELSE 0 END) as jumlah_tiket_0');
        $this->db->select('SUM(1) as jumlah_total_tiket');
        $this->db->from('tiket');
        $this->db->join('event', 'event.id_event = tiket.id_event');
        $this->db->where('event.id_user', $id_user);

        $query = $this->db->get();
        return $query->row();
    }
}