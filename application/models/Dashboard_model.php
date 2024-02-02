<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function get_total_nominal($id_user)
    {
        $this->db->select_sum('saldo.nominal');
        $this->db->from('saldo');
        $this->db->join('transaksi', 'transaksi.code_bayar = saldo.code_bayar');
        $this->db->join('event', 'event.id_event = transaksi.id_event');
        $this->db->where('event.id_user', $id_user);

        $query = $this->db->get();
        return $query->row()->nominal;
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

    public function get_tiket_terjual($id_user)
    {
        $this->db->select_sum('transaksi.jumlah_tiket');
        $this->db->from('transaksi');
        $this->db->join('event', 'event.id_event = transaksi.id_event');
        $this->db->where('event.id_user', $id_user);

        $query = $this->db->get();
        return $query->row()->jumlah_tiket;
    }

    public function get_tiket_status($id_user)
    {
        $this->db->select('SUM(CASE WHEN status_tiket = 1 THEN 1 ELSE 0 END) as jumlah_tiket_1');
        $this->db->select('SUM(CASE WHEN status_tiket = 0 THEN 1 ELSE 0 END) as jumlah_tiket_0');
        $this->db->from('tiket');
        $this->db->join('event', 'event.id_event = tiket.id_event');
        $this->db->where('event.id_user', $id_user);

        $query = $this->db->get();
        return $query->row();
    }


}