<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi extends CI_Model
{
    function m_paynow($email, $code_bayar)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('transaksi', 'transaksi.id_customer = customer.id_customer');
        $this->db->join('tiket', 'tiket.code_bayar = transaksi.code_bayar');
        $this->db->join('price', 'price.id_event = transaksi.id_event');
        $this->db->where('customer.email', $email);
        $this->db->where('transaksi.code_bayar', $code_bayar);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    function m_data_transaksi($email)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('transaksi', 'transaksi.id_customer = customer.id_customer');
        $this->db->join('event', 'event.id_event = transaksi.id_event');
        $this->db->where('customer.email', $email);
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }

    function m_detail_tiket($code_bayar)
    {
        $this->db->select('SUM(tiket.status = "free") as jumlah_free, COUNT(tiket.status = " ") as total_rows, kategori_price AS tiket, harga AS harga_tiket, tiket.status AS status_');
        $this->db->from('tiket');
        $this->db->join('price', 'price.id_price = tiket.id_price');
        $this->db->where('tiket.code_bayar', $code_bayar);
        $this->db->where('price.status_bundling', '0');
        $this->db->group_by('tiket.id_price');
        $query = $this->db->get();
        return $query->result();
    }

    function m_detail_tiket_bundling($code_bayar)
    {
        $this->db->select('COUNT(*) as jumlah, kategori_price AS tiket, harga AS harga_tiket, tiket.status AS status_');
        $this->db->from('tiket');
        $this->db->join('price', 'price.id_price = tiket.id_price');
        $this->db->where('tiket.code_bayar', $code_bayar);
        $this->db->where('price.status_bundling', '1');
        $this->db->group_by('tiket.id_price');
        $query = $this->db->get();
        return $query->result();
    }

    function m_detail_trans($code_bayar)
    {
        // $bulan = '10';
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('transaksi.code_bayar', $code_bayar);
        $query = $this->db->get();
        return $query->result();
    }

    function m_detail_event($code_bayar)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('event', 'event.id_event = transaksi.id_event');
        $this->db->where('transaksi.code_bayar', $code_bayar);
        $query = $this->db->get();
        return $query->result();
    }

    function event_slide()
    {
        $this->db->select('*');
        $this->db->from('event');
        $query = $this->db->get();
        return $query->result();
    }

    function m_detail_buyer($code_bayar)
    {
        // $bulan = '10';
        $this->db->select('*');
        $this->db->from('tiket');
        $this->db->join('price', 'price.id_price = tiket.id_price');
        $this->db->where('tiket.code_bayar', $code_bayar);
        // $this->db->group_by('tiket.id_price');
        $query = $this->db->get();
        return $query->result();
    }

    function m_select_tiket($code_bayar)
    {
        $this->db->select('*');
        $this->db->from('tiket');
        $this->db->where('code_bayar', $code_bayar);
        $query = $this->db->get();
        return $query->result();
    }

    function m_delete_transaksi_tiket($code_bayar)
    {
        $delete_transaksi = $this->db->where('code_bayar', $code_bayar)
            ->delete('transaksi');
        $delete_tiket = $this->db->where('code_bayar', $code_bayar)
            ->delete('tiket');
        return $delete_transaksi;
        return $delete_tiket;
    }

    function m_update_stock_tiket($id_price, $stock_tiket)
    {
        $update = $this->db->set('stock_tiket', $stock_tiket)
            ->where('id_price', $id_price)
            ->update('price');
        return $update;
    }
}