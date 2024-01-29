<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_tiket extends CI_Model
{
    function m_data_tiket($email)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('transaksi', 'transaksi.id_customer = customer.id_customer');
        $this->db->join('tiket', 'tiket.id_customer = customer.id_customer');
        $this->db->join('price', 'price.id_price = tiket.id_price');
        $this->db->where('customer.email', $email);
        // $this->db->where('status_tiket', '1');
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }

    function m_detail_tiket($email, $code_tiket)
    {
        // $bulan = '10';
        $this->db->select('*');
        $this->db->from('tiket');
        $this->db->join('customer', 'customer.id_customer = tiket.id_customer');
        $this->db->join('price', 'price.id_price = tiket.id_price');
        $this->db->where('customer.email', $email);
        $this->db->where('tiket.code_tiket', $code_tiket);
        // $this->db->where('status_tiket', '1');
        $query = $this->db->get();
        return $query->result();
    }
}