<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_callback extends CI_Model
{
    function m_data_tiket($_externalId)
    {
        $this->db->select('tiket.id_price, COUNT(*) AS ticket_count, price.kategori_price');
        $this->db->from('tiket');
        $this->db->Join('price', 'price.id_price = tiket.id_price');
        $this->db->where('code_bayar', $_externalId);
        $this->db->group_by('tiket.id_price');
        $query = $this->db->get();
        return $query->result();
    }
    function m_data_transaksi($_externalId)
    {
        $this->db->select('transaksi.*, event.*, kategori_event.*, customer.*, customer.kota as kota_customer, wilayah_kabupaten.*');
        $this->db->from('transaksi');
        $this->db->Join('event', 'event.id_event = transaksi.id_event');
        $this->db->Join('kategori_event', 'kategori_event.id_kategori_event = event.id_kategori_event');
        $this->db->Join('customer', 'customer.id_customer = transaksi.id_customer');
        $this->db->Join('wilayah_kabupaten', 'wilayah_kabupaten.id = event.kota');
        $this->db->where('transaksi.code_bayar', $_externalId);
        $query = $this->db->get();
        return $query->result();
    }

    function m_data_e_tiket($_externalId)
    {

        $this->db->select('*');
        $this->db->from('tiket');
        // $this->db->Join('price', 'price.id_price = tiket.id_price');
        $this->db->where('code_bayar', $_externalId);
        // $this->db->group_by('tiket.id_price');
        $query = $this->db->get();
        return $query->result();
    }
}
